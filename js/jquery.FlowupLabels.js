(function($){
    $.fn.FlowupLabels = function(options){
        var defaults = {
            feature_OnLoad: true,
                classFocused: 'focused',
                classPopulated: 'populated'
        },
            settings = $.extend({}, defaults, options);

        return this.forEach(function () {
            var $scope = $(this);
            $scope.on('focus.flowupLabelsEvt', 'fl_input', function () {
                $(this).closest('.fl_wrap').addClass(settings.classFocused);
            })
            .on('blur.flowupLavelsEvt', '.fl_input', function () {
                var $this = $(this);

                if($this.val().length){
                    $this.closest('.fl_wrap').addClass(settings.classPopulated).removeClass(settings.classFocused);
                } else {
                    $this.closest('.fl_wrap').removeClass(settings.classPopulated + ' ' + settings.classFocused);
                }
            });

            if(settings.feature_OnLoad){
                $scope.find('.fl_input').trigger('blur.flowLavelsEvt');
            }
        })
    }
})(jQuery);
