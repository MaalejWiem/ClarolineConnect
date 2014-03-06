<?php

/**
 * ExoOnLine
 * Copyright or © or Copr. Université Jean Monnet (France), 2012
 * dsi.dev@univ-st-etienne.fr
 *
 * This software is a computer program whose purpose is to [describe
 * functionalities and technical features of your software].
 *
 * This software is governed by the CeCILL license under French law and
 * abiding by the rules of distribution of free software.  You can  use,
 * modify and/ or redistribute the software under the terms of the CeCILL
 * license as circulated by CEA, CNRS and INRIA at the following URL
 * "http://www.cecill.info".
 *
 * As a counterpart to the access to the source code and  rights to copy,
 * modify and redistribute granted by the license, users are provided only
 * with a limited warranty  and the software's author,  the holder of the
 * economic rights,  and the successive licensors  have only  limited
 * liability.
 *
 * In this respect, the user's attention is drawn to the risks associated
 * with loading,  using,  modifying and/or developing or reproducing the
 * software by the user in light of its specific status of free software,
 * that may mean  that it is complicated to manipulate,  and  that  also
 * therefore means  that it is reserved for developers  and  experienced
 * professionals having in-depth computer knowledge. Users are therefore
 * encouraged to load and test the software's suitability as regards their
 * requirements in conditions enabling the security of their systems and/or
 * data to be ensured and,  more generally, to use and operate it in the
 * same conditions as regards security.
 *
 * The fact that you are presently reading this means that you have had
 * knowledge of the CeCILL license and that you accept its terms.
*/

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UJM\ExoBundle\Services\classes;

use Claroline\CoreBundle\Library\Resource\ResourceCollection;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContextInterface;

use UJM\ExoBundle\Entity\ExerciseQuestion;

class exerciseServices
{
    protected $doctrine;
    protected $securityContext;

    public function __construct(Registry $doctrine, SecurityContextInterface $securityContext)
    {
        $this->doctrine        = $doctrine;
        $this->securityContext = $securityContext;
    }

    public function getIP()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function responseQCM($request, $paperID = 0)
    {
        $res = array();
        $interactionQCMID = $request->request->get('interactionQCMToValidated');
        $response = array();

        $em = $this->doctrine->getManager();
        $interQCM = $em->getRepository('UJMExoBundle:InteractionQCM')->find($interactionQCMID);

        if ($interQCM->getTypeQCM()->getId() == 2) {
            $response[] = $request->request->get('choice');
        } else {
            if ($request->request->get('choice') != null) {
                $response = $request->request->get('choice');
            }
        }

        $allChoices = $interQCM->getChoices();

        $penalty = 0;

        $session = $request->getSession();

        if ($paperID == 0) {
            if ($session->get('penalties')) {
                foreach ($session->get('penalties') as $penal) {
                    $penalty += $penal;
                }
            }
            $session->remove('penalties');
        } else {
            $penalty = $this->getPenalty($interQCM->getInteraction(), $paperID);
        }

        $score = $this->qcmMark($interQCM, $response, $allChoices, $penalty);

        $responseID = '';

        foreach ($response as $res) {
            if ($res != null) {
                $responseID .= $res.';';
            }
        }

        $res = array(
            'score'    => $score,
            'penalty'  => $penalty,
            'interQCM' => $interQCM,
            'response' => $responseID
        );

        return $res;

    }

    public function qcmMark(\UJM\ExoBundle\Entity\InteractionQCM $interQCM, array $response, $allChoices, $penality)
    {
        $score = 0;
        $scoreMax = $this->qcmMaxScore($interQCM);

        $rightChoices = array();
        $markByChoice = array();

        if (!$interQCM->getWeightResponse()) {
            foreach ($allChoices as $choice) {
                if ($choice->getRightResponse()) {
                    $rightChoices[] = (string) $choice->getId();
                }
            }

            $result = array_diff($response, $rightChoices);
            $resultBis = array_diff($rightChoices, $response);

            if ((count($result) == 0) && (count($resultBis) == 0)) {
                $score = $interQCM->getScoreRightResponse() - $penality;
            } else {
                $score = $interQCM->getScoreFalseResponse() - $penality;
            }
            if ($score < 0) {
                $score = 0;
            }

            $score .= ' / '.$scoreMax;
        } else {
            //points par réponse
            foreach ($allChoices as $choice) {
                $markByChoice[(string) $choice->getId()] = $choice->getWeight();
            }

            foreach ($response as $res) {
                $score += $markByChoice[$res];
            }

            if ($score > $scoreMax) {
                $score = $scoreMax;
            }

            $score -= $penality;

            if ($score < 0) {
                $score = 0;
            }
            $score .= '/'.$scoreMax;
        }

        return $score;
    }

    /**
     * Return the number of papers for an exercise and foran user
     *
     */
    public function getNbPaper($uid, $exoID)
    {
        $papers = $this->doctrine
                       ->getManager()
                       ->getRepository('UJMExoBundle:Paper')
                       ->getExerciseUserPapers($uid, $exoID);

        return count($papers);
    }

    private function getPenalty($interaction, $paperID)
    {
        $penalty = 0;
        $em = $this->doctrine->getManager();

        $hints = $interaction->getHints();

        foreach ($hints as $hint) {
            $lhp = $this->doctrine
                        ->getManager()
                        ->getRepository('UJMExoBundle:LinkHintPaper')
                        ->getLHP($hint->getId(), $paperID);
            if (count($lhp) > 0) {
                $signe = substr($hint->getPenalty(), 0, 1);

                if ($signe == '-') {
                    $penalty += substr($hint->getPenalty(), 1);
                } else {
                    $penalty += $hint->getPenalty();
                }
            }
        }

        return $penalty;
    }

    public function responseGraphic($request, $paperID = 0)
    {
        $answers = $request->request->get('answers'); // Answer of the student
        $graphId = $request->request->get('graphId'); // Id of the graphic interaction
        $max = $request->request->get('nbpointer'); // Number of answer zones

        $em = $this->doctrine->getManager();

        $rightCoords = $em->getRepository('UJMExoBundle:Coords')
            ->findBy(array('interactionGraphic' => $graphId));

        $interG = $em->getRepository('UJMExoBundle:InteractionGraphic')
            ->find($graphId);

        $doc = $em->getRepository('UJMExoBundle:Document')
            ->findOneBy(array('id' => $interG->getDocument()));

        $verif = array();
        $point = $z = $total = 0;

        $coords = preg_split('[;]', $answers); // Divide the answer zones into cells

        for ($i = 0; $i < $max - 1; $i++) {
            for ($j = 0; $j < $max - 1; $j++) {
                list($xa,$ya) = explode("-", $coords[$j]); // Answers of the student
                list($xr,$yr) = explode(",", $rightCoords[$i]->getValue()); // Right answers

                $valid = $rightCoords[$i]->getSize() / 2; // Size of the answer zone

                // If answer student is in right answer
                if ((($xa) < ($xr + $valid)) && (($xa) > ($xr - $valid)) && (($ya) < ($yr + $valid)) &&
                    (($ya) > ($yr - $valid))
                ) {
                    // Not get points twice for one answer
                    if ($this->alreadyDone($rightCoords[$i]->getValue(), $verif, $z)) {
                        $point += $rightCoords[$i]->getScoreCoords(); // Score of the student without penalty
                        $verif[$z] = $rightCoords[$i]->getValue(); // Add this answer zone to already answered zones
                        $z++;
                    }
                }
            }
            $total = $this->graphicMaxScore($interG); // Score max
        }

        $penalty = 0;

        $session = $request->getSession();

        // Not assessment
        if ($paperID == 0) {
            if ($session->get('penalties')) {
                foreach ($session->get('penalties') as $penal) {

                    $signe = substr($penal, 0, 1); // In order to manage the symbol of the penalty

                    if ($signe == '-') {
                        $penalty += substr($penal, 1);
                    } else {
                        $penalty += $penal;
                    }
                }
            }
            $session->remove('penalties');
        } else {
            $penalty = $this->getPenalty($interG->getInteraction(), $paperID);
        }

        $score = $point - $penalty; // Score of the student with penalty

        // Not negatif score
        if ($score < 0) {
            $score = 0;
        }

        if (!preg_match('/[0-9]+/', $answers)) {
            $answers = '';
        }

        $res = array(
            'point' => $point, // Score of the student without penalty
            'penalty' => $penalty, // Penalty (hints)
            'interG' => $interG, // The entity interaction graphic (for the id ...)
            'coords' => $rightCoords, // The coordonates of the right answer zones
            'doc' => $doc, // The answer picture (label, src ...)
            'total' => $total, // Score max if all answers right and no penalty
            'rep' => $coords, // Coordonates of the answer zones of the student's answer
            'score' => $score, // Score of the student (right answer - penalty)
            'response' => $answers // The student's answer (with all the informations of the coordonates)
        );

        return $res;
    }

    public function responseOpen($request, $paperID = 0)
    {
        $res = array();
        $interactionOpenID = $request->request->get('interactionOpenToValidated');
        $response = '';
        $tempMark = true;

        $penalty = 0;
        $session = $request->getSession();

        $em = $this->doctrine->getManager();
        $interOpen = $em->getRepository('UJMExoBundle:InteractionOpen')->find($interactionOpenID);

        if ($interOpen->getTypeOpenQuestion() == 'long') {
            $response = $request->request->get('interOpenLong');
        }

        // Not assessment
        if ($paperID == 0) {
            if ($session->get('penalties')) {
                foreach ($session->get('penalties') as $penal) {

                    $signe = substr($penal, 0, 1); // In order to manage the symbol of the penalty

                    if ($signe == '-') {
                        $penalty += substr($penal, 1);
                    } else {
                        $penalty += $penal;
                    }
                }
            }
            $session->remove('penalties');
        } else {
            $penalty = $this->getPenalty($interOpen->getInteraction(), $paperID);
        }

        if ($interOpen->getTypeOpenQuestion() == 'long') {
            $score = -1;
        }

        $score .= '/'.$this->openMaxScore($interOpen);

        $res = array(
            'penalty'   => $penalty,
            'interOpen' => $interOpen,
            'response'  => $response,
            'score'     => $score,
            'tempMark'  => $tempMark
        );

        return $res;
    }

    // Check if the suggested answer zone isn't already right in order not to have points twice
    public function alreadyDone($coor, $verif, $z)
    {
        $resu = true;

        for ($v = 0; $v < $z; $v++) {
            // if already placed at this right place
            if ($coor == $verif[$v]) {
                $resu = false;
                break;
            } else {
                $resu = true;
            }
        }

        return $resu;
    }

    public function getExerciseTotalScore($exoID)
    {
        $exoTotalScore = 0;

        $eqs = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:ExerciseQuestion')
            ->findBy(array('exercise' => $exoID));

        foreach ($eqs as $eq) {
            $interaction = $this->doctrine
                ->getManager()
                ->getRepository('UJMExoBundle:Interaction')
                ->getInteraction($eq->getQuestion()->getId());//echo $interaction[0]->getInvite();

            switch ($interaction[0]->getType()){
                case 'InteractionQCM':
                    $interQCM = $this->doctrine
                                     ->getManager()
                                     ->getRepository('UJMExoBundle:InteractionQCM')
                                     ->getInteractionQCM($interaction[0]->getId());
                    $scoreMax = $this->qcmMaxScore($interQCM[0]);
                    break;
                case 'InteractionGraphic':
                    $interGraphic = $this->doctrine
                                         ->getManager()
                                         ->getRepository('UJMExoBundle:InteractionGraphic')
                                         ->getInteractionGraphic($interaction[0]->getId());
                    $scoreMax = $this->graphicMaxScore($interGraphic[0]);
                    break;
                case 'InteractionOpen':
                    $interOpen = $this->doctrine
                                      ->getManager()
                                      ->getRepository('UJMExoBundle:InteractionOpen')
                                      ->getInteractionOpen($interaction[0]->getId());
                    $scoreMax = $this->openMaxScore($interOpen[0]);
                    break;
            }

            $exoTotalScore += $scoreMax;
        }

        return $exoTotalScore;
    }

    public function getExercisePaperTotalScore($paperID)
    {
        $exercisePaperTotalScore = 0;
        $paper = $interaction = $this->doctrine
                                     ->getManager()
                                     ->getRepository('UJMExoBundle:Paper')
                                     ->find($paperID);

        $interQuestions = $paper->getOrdreQuestion();
        $interQuestions = substr($interQuestions, 0, strlen($interQuestions) - 1);
        $interQuestionsTab = explode(";", $interQuestions);

        foreach ($interQuestionsTab as $interQuestion) {
            $interaction = $this->doctrine->getManager()->getRepository('UJMExoBundle:Interaction')->find($interQuestion);
            switch ( $interaction->getType()) {
                case "InteractionQCM":
                    $interQCM = $this->doctrine
                                     ->getManager()
                                     ->getRepository('UJMExoBundle:InteractionQCM')
                                     ->getInteractionQCM($interaction->getId());
                    $exercisePaperTotalScore += $this->qcmMaxScore($interQCM[0]);
                    break;

                case "InteractionGraphic":
                    $interGraphic = $this->doctrine
                                         ->getManager()
                                         ->getRepository('UJMExoBundle:InteractionGraphic')
                                         ->getInteractionGraphic($interaction->getId());
                    $exercisePaperTotalScore += $this->graphicMaxScore($interGraphic[0]);
                    break;

                case "InteractionHole":

                    break;

                case "InteractionOpen":
                    $interOpen = $this->doctrine
                                      ->getManager()
                                      ->getRepository('UJMExoBundle:InteractionOpen')
                                      ->getInteractionOpen($interaction->getId());
                    $exercisePaperTotalScore += $this->openMaxScore($interOpen[0]);
                    break;
            }
        }

        return $exercisePaperTotalScore;
    }

    public function qcmMaxScore($interQCM)
    {
        $scoreMax = 0;

        /*$interQCM = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:InteractionQCM')
            ->getInteractionQCM($interaction->getId());*/

        if (!$interQCM->getWeightResponse()) {
            $scoreMax = $interQCM->getScoreRightResponse();
        } else {
            foreach ($interQCM->getChoices() as $choice) {
                if ($choice->getRightResponse()) {
                    $scoreMax += $choice->getWeight();
                }
            }
        }

        return $scoreMax;
    }

    public function graphicMaxScore($interGraphic)
    {
        $scoreMax = 0;

        /*$interGraphic = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:InteractionGraphic')
            ->getInteractionGraphic($interaction->getId());*/

        $rightCoords = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:Coords')
            ->findBy(array('interactionGraphic' => $interGraphic->getId()));

        foreach ($rightCoords as $score) {
            $scoreMax += $score->getScoreCoords(); // Score max
        }

        return $scoreMax;
    }

    public function openMaxScore($interOpen)
    {
        $scoreMax = 0;

        /*$interOpen = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:InteractionOpen')
            ->getInteractionOpen($interaction->getId());*/

        if ($interOpen->getTypeOpenQuestion() == 'long') {
            $scoreMax = $interOpen->getScoreMaxLongResp();
        }

        return $scoreMax;
    }

    public function setExerciseQuestion($exercise, $interX)
    {
        $exo = $this->doctrine->getManager()->getRepository('UJMExoBundle:Exercise')->find($exercise);
        $eq = new ExerciseQuestion($exo, $interX->getInteraction()->getQuestion());

        $dql = 'SELECT max(eq.ordre) FROM UJM\ExoBundle\Entity\ExerciseQuestion eq '
              . 'WHERE eq.exercise='.$exercise;
        $query = $this->doctrine->getManager()->createQuery($dql);
        $maxOrdre = $query->getResult();

        $eq->setOrdre((int) $maxOrdre[0][1] + 1);
        $this->doctrine->getManager()->persist($eq);

        $this->doctrine->getManager()->flush();
    }

    /**
     * Round up or down parameter's value
     *
     */
    public function roundUpDown($toBeAdjusted)
    {
        return (round($toBeAdjusted / 0.5) * 0.5);
    }

    /**
     * To control the subscription
     *
     */
    public function isExerciseAdmin($exercise)
    {
        $user = $this->securityContext->getToken()->getUser();

        $subscription = $this->doctrine
            ->getManager()
            ->getRepository('UJMExoBundle:Subscription')
            ->getControlExerciseEnroll($user->getId(), $exercise->getId());

        if (count($subscription) > 0) {
            return $subscription[0]->getAdmin();
        } else {
            $collection = new ResourceCollection(array($exercise->getResourceNode()));
            if ($this->securityContext->isGranted('edit', $collection)) {
                return 1;
            } else {
                return 0;
            }
        }

    }
}