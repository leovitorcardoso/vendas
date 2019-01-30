var css = [
    'plugins/bootstrap/css/bootstrap.min.css',
    'plugins/fontawesome-free/css/all.min.css',
    'plugins/datatables/css/dataTables.bootstrap4.css',
    'plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css',
    'plugins/sb-admin/css/sb-admin.css',
    'plugins/custom/css/custom.css'
];

var js = [
    'plugins/jquery/jquery.min.js',
    'plugins/bootstrap/js/bootstrap.bundle.min.js',
    'plugins/jquery-easing/jquery.easing.min.js',
    'plugins/chart.js/Chart.min.js',
    'plugins/datatables/js/jquery.dataTables.js',
    'plugins/datatables/js/dataTables.bootstrap4.js',
    'plugins/sweetalert/js/sweetalert.min.js',
    'plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js',
    'plugins/sb-admin/js/sb-admin.min.js',
    'plugins/custom/js/custom.js'
];

module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        copy: {
            js: {
                files: [
                    {
                        expand: true,
                        cwd: 'node_modules/jquery/dist/',
                        src: ['*.js', '*.map'],
                        dest: 'plugins/jquery/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/jquery.easing/',
                        src: '*.js',
                        dest: 'plugins/jquery-easing/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/bootstrap/dist/js/',
                        src: '*.js',
                        dest: 'plugins/bootstrap/js/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/chart.js/dist/',
                        src: '*.js',
                        dest: 'plugins/chart.js/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/datatables.net-bs4/js/',
                        src: '*.js',
                        dest: 'plugins/datatables/js/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/sweetalert/dist/',
                        src: '*.js',
                        dest: 'plugins/sweetalert/js/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/bootstrap-touchspin/dist/',
                        src: '*.js',
                        dest: 'plugins/bootstrap-touchspin/js/'
                    }
                ]
            },
            css: {
                files: [
                    {
                        expand: true,
                        cwd: 'node_modules/bootstrap/dist/css/',
                        src: '*.css',
                        dest: 'plugins/bootstrap/css/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/datatables.net-bs4/css/',
                        src: '*.css',
                        dest: 'plugins/datatables/css/'
                    },
                    {
                        expand: true,
                        cwd: 'node_modules/bootstrap-touchspin/dist/',
                        src: '*.css',
                        dest: 'plugins/bootstrap-touchspin/css/'
                    }
                ]
            }
        },

        watch: {
            js: {
                files: [
                    'plugins/custom/js/*.js'
                ],
                tasks: ['uglify'],
                options: {
                    livereload: true
                },
            },
            css: {
                files: [
                    'plugins/custom/css/*.css'
                ],
                tasks: ['cssmin']
            }
        },

        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'css/stylesheets.min.css': css
                }
            }
        },

        uglify: {
            my_target: {
                files: {
                    'js/javascripts.min.js': js
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['copy', 'uglify', 'cssmin']);
};