"use strict";

module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    banner: [
      '/*!',
      ' * Wordpress Bootstrap <%= pkg.version %>',
      ' * Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author.name %> (<%= pkg.author.url %>)',
      ' */',
      ''
    ].join('\n'),
    less: {
      dist: {
        options: {
          banner: '<%= banner %>',
          compress: true
        },
        src: ['less/main.less'],
        dest: 'css/main.min.css'
      }
    },
    uglify: {
      dist: {
        options: {
          banner: '<%= banner %>',
          compress: true
        },
        src: [
          'vendor/bootstrap/js/transition.js',
          // 'vendor/bootstrap/js/alert.js',
          // 'vendor/bootstrap/js/button.js',
          // 'vendor/bootstrap/js/carousel.js',
          // 'vendor/rygine/looper/src/looper.js',
          'vendor/bootstrap/js/collapse.js',
          // 'vendor/bootstrap/js/dropdown.js',
          // 'vendor/bootstrap/js/modal.js',
          // 'vendor/bootstrap/js/tooltip.js',
          // 'vendor/bootstrap/js/popover.js',
          // 'vendor/bootstrap/js/scrollspy.js',
          // 'vendor/bootstrap/js/tab.js',
          // 'vendor/bootstrap/js/affix.js',
          // 'vendor/flesler/jquery.scrollTo.js',
          // 'js/single-page.js',
          'js/js.js'
        ],
        dest: 'js/main.min.js'
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['less', 'uglify']);

};