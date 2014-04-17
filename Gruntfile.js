module.exports = function (grunt) {
    grunt.initConfig({
        // Metadata.
        meta: {
            version: '1.0.0'
        },
        copy: {
            main: {
                files: [
                    {
                        expand: true,
                        flatten: true,
                        src: './bower_components/font-awesome/fonts/*',
                        dest: 'web/fonts'
                    }
                ]
            },
            images: {
                files: [
                    {
                        expand: true,
                        flatten: true,
                        src: './app/Resources/images/*',
                        dest: 'web/images'
                    }
                ]
            }
        },
        less: {
            dev: {
                compress: false,
                debug: true,
                files: {
                    "./web/css/style.css": ["app/Resources/styles/main.less"]
                }
            },
            prod: {
                compress: true,
                files: {
                    "./web/css/style.css": "./web/css/main.less"
                }
            }
        },
        watch: {
            options: {
                livereload: true
            },
            js: {
                files: ['app/Resources/scripts/*.js', 'app/Resources/scripts/**/*.js'],
                tasks: ['concat', 'less:dev']
            },
            css: {
                files: ['app/Resources/styles/*.less'],
                tasks: ['concat', 'less:dev']
            }
        },
        concat: {
            css: {
                src: [
                    'bower_components/bootstrap/dist/css/bootstrap.css',
                    'bower_components/font-awesome/css/font-awesome.css'
                ],
                dest: 'web/css/3rd.css'
            },
            js: {
                src: [
                    'bower_components/jquery/dist/jquery.js',
                    'bower_components/bootstrap/dist/js/bootstrap.min.js',
                    'app/Resources/scripts/start.js'
                ],
                dest: 'web/js/script.js'
            }
        },
        clean: {
            dev: {
                src: ["web/css/*", "web/js/*", "web/fonts/*"]
            }
        }
    });

    // Load the plugins
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-bower-task');

    //#################### BEGIN TASKS REGISTER ####################
    // Default task
    grunt.registerTask('default', ['copy', 'concat', 'less:dev']);

    // Remove sass, compass cache and compiled css
    grunt.registerTask('clear', ['clean']);

    // Production task
    grunt.registerTask('prod', []);
    //#################### END TASKS REGISTER ####################

    // Watcher
    grunt.event.on('watch', function(action, filepath, target) {
        grunt.log.writeln(target + ': ' + filepath + ' has ' + action);
    });
};