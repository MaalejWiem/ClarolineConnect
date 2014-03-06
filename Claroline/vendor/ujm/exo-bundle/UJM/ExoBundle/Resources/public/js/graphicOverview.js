// Get the answers of the student to display it for the correction
window.onload = function () {

    if ($('#info').length > 0) {
        var infos = $('#info').val();
        var i = infos.substr(0, infos.indexOf('~'));
        infos = infos.substr(infos.indexOf('~') + 1);
        var info = infos.split('^');

        for (var x = 0 ; x < i ; x++) {
            var content = info[x].split(';');
            whichImg(content[0], content[1], x, content[3], content[4], content[5], content[6], content[2], content[7], 1);
        }
    }
};

function whichImg(shape, color, i, x, y, rx, ry, prefix, size, id) {

    // Set the shape/color of the answer zone
    if (shape == 'circle') {
        switch (color) {
        case 'white' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circlew.png');
            break;

        case 'red' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circler.png');
            break;

        case 'blue' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circleb.png');
            break;

        case 'purple' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circlep.png');
            break;

        case 'green' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circleg.png');
            break;

        case 'orange' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circleo.png');
            break;

        case 'yellow' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circley.png');
            break;

        default :
            $('#' + id + 'ra' + i).attr('src', prefix + 'circlew.png');
            break;
        }

    } else if (shape == 'square') {
        switch (color) {
        case 'white' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squarew.jpg');
            break;

        case 'red' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squarer.jpg');
            break;

        case 'blue' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squareb.jpg');
            break;

        case 'purple' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squarep.jpg');
            break;

        case 'green' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squareg.jpg');
            break;

        case 'orange' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squareo.jpg');
            break;

        case 'yellow' :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squarey.jpg');
            break;

        default :
            $('#' + id + 'ra' + i).attr('src', prefix + 'squarew.jpg');
        }
    }

    // Set the width of the answer zone
    $('#' + id + 'ra' + i).width(size);

    // Place the right answer zones
    $('#' + id + 'ra' + i).css({
        "position" : "absolute",
        "left" : x + 'px',
        "top"  : y + 'px'
    });

    // Place student's answer zones if defined
    if (rx != 'a' && ry != 'a' && rx != '' && ry != '') {
        $('#' + id + 'cursor' + i).css({
            "position" : "absolute",
            "left" : rx.trim() + 'px',
            "top"  : ry + 'px'
        });

    } else { // Else don't display the unplaced answer zone of the student
        $('#' + id + 'cursor' + i).css ({ "visibility" : "hidden"});
    }
}