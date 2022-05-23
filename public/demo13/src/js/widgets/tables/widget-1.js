"use strict";

// Class definition
var KTTablesWidget1 = function () {
    // Private methods
    var initDatatable = function() {
        //alert('Tables widget 1');
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
        }   
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTTablesWidget1;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTTablesWidget1.init();
});
