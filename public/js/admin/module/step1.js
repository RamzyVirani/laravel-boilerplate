$(function() {
    $('#module-hep').hide();

    $("#module-name").keyup(function(){
        var module_name = $(this).val();
        var nameReg = /^[A-Za-z]*$/;

        var slug = module_name.replace(/ /g, '-').replace(/_/g, '-').toLowerCase();

        if (module_name.match(nameReg) != null){
            module_name = ucwords(module_name);
        }else{
            if (module_name.indexOf(" ") >= 0){      // ' ' present
                module_name = removeSpace(module_name);
            }
            if (module_name.indexOf("_") >= 0){      // '_' present
                module_name = removeUnderscore(module_name);
            }
            module_name = ucwords(module_name.replace(/[^A-Za-z]/g, ''));
        }

        $('#module-hep').html('Model Class -> '+pluralize.singular(module_name));
        // $('#slug').val(pluralize.singular(module_name).toLowerCase());
        $('#slug').val(pluralize.singular(slug));
        $('#module').val('');
        $('#module').val(pluralize.singular(module_name));
        $('#module-hep').show();
    });
});

/*function slug(title, separator) {
    if(typeof separator == 'undefined') separator = '-';

    // Convert all dashes/underscores into separator
    var flip = separator == '-' ? '_' : '-';
    title = title.replace(flip, separator);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    title = title.toLowerCase()
        .replace(new RegExp('[^a-z0-9' + separator + '\\s]', 'g'), '');

    // Replace all separator characters and whitespace by a single separator
    title = title.replace(new RegExp('[' + separator + '\\s]+', 'g'), separator);

    return title.replace(new RegExp('^[' + separator + '\\s]+|[' + separator + '\\s]+$', 'g'),'');
}*/

function isInt(value) {
    return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
}

function removeNumber(value) {
    return ucwords(value.substr(1));
}

function removeUnderscore(value) {
    var res = value.split("_");
    $.each(res, function( key, res_value ) {
        res[key] = ucwords(res_value.toLowerCase());
    });
    return res.join().replace(",", "");
}

function removeSpace(value) {
    var res = value.split(" ");
    $.each( res, function( key, res_value ) {
        if(res_value !== "") {
            res[key] = ucwords(res_value.toLowerCase());
        }
    });

    return res.join().replace(",", "");
}

function modelFile_name(value) {
    return  ucwords(value);
}

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}