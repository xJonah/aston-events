//Function found on stack overflow to print more details of a list - Referenced in report

$(function () {
    $('#read1').click(function () {
        $('#datalist1 li:hidden').slice(0, 3).show();
        if ($('#datalist1 li').length == $('#datalist1 li:visible').length) {
            $('#read1').hide();
        }
    });
});

$(function () {
    $('#read2').click(function () {
        $('#datalist2 li:hidden').slice(0, 3).show();
        if ($('#datalist2 li').length == $('#datalist2 li:visible').length) {
            $('#read2').hide();
        }
    });
});

$(function () {
    $('#read3').click(function () {
        $('#datalist3 li:hidden').slice(0, 3).show();
        if ($('#datalist3 li').length == $('#datalist3 li:visible').length) {
            $('#read3').hide();
        }
    });
});

$(function () {
    $('#read4').click(function () {
        $('#datalist4 li:hidden').slice(0, 3).show();
        if ($('#datalist4 li').length == $('#datalist4 li:visible').length) {
            $('#read4').hide();
        }
    });
});

$(function () {
    $('#read5').click(function () {
        $('#datalist5 li:hidden').slice(0, 3).show();
        if ($('#datalist5 li').length == $('#datalist5 li:visible').length) {
            $('#read5').hide();
        }
    });
});

$(function () {
    $('#read6').click(function () {
        $('#datalist6 li:hidden').slice(0, 3).show();
        if ($('#datalist6 li').length == $('#datalist6 li:visible').length) {
            $('#read6').hide();
        }
    });
});
