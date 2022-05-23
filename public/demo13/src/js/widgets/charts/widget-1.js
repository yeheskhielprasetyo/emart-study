"use strict";

// Class definition
var KTChartsWidget1 = function () {
    // Private methods
    var initChart = function() {
        //alert('Charts widget 1');
    }

    // Public methods
    return {
        init: function () {
            initChart();
        }   
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTChartsWidget1;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTChartsWidget1.init();
});
