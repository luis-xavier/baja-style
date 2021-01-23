 'use strict';
 (function($){
    $(function(){

        if( $('#grve-head-code-area').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                }
            );
            var editor = wp.codeEditor.initialize( $('#grve-head-code-area'), editorSettings );
        }
        if( $('#grve-body-code-area').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2
                }
            );
            var editor = wp.codeEditor.initialize( $('#grve-body-code-area'), editorSettings );
        }
        if( $('#grve-footer-code-area').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                  indentUnit: 2,
                  tabSize: 2,
                }
            );
            var editor = wp.codeEditor.initialize( $('#grve-footer-code-area'), editorSettings );
        }
    });
 })(jQuery);