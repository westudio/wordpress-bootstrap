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
    recess: {
      dist: {
        options: {
          banner: '<%= banner %>',
          compress: true
        },
        src: ['less/<%= pkg.name %>.less'],
        dest: 'css/<%= pkg.name %>.min.css'
      }
    },
    concat: {
      dist: {
        options: {
          separator: ';'
        },
        src: [
          'vendor/bootstrap/js/transition.js',
          // 'vendor/bootstrap/js/alert.js',
          // 'vendor/bootstrap/js/button.js',
          // 'vendor/bootstrap/js/carousel.js',
          'vendor/bootstrap/js/collapse.js',
          // 'vendor/bootstrap/js/dropdown.js',
          // 'vendor/bootstrap/js/modal.js',
          // 'vendor/bootstrap/js/tooltip.js',
          // 'vendor/bootstrap/js/popover.js',
          // 'vendor/bootstrap/js/scrollspy.js',
          // 'vendor/bootstrap/js/tab.js',
          // 'vendor/bootstrap/js/affix.js',
          // 'vendor/blueimp/load-image/load-image.js',
          // 'vendor/blueimp/modal-gallery/modal-gallery.js',
          // 'vendor/flesler/jquery.scrollTo.js',
          // 'js/single-page.js',
          'js/js.js'
        ],
        dest: 'js/<%= pkg.name %>.js'
      }
    },
    uglify: {
      dist: {
        options: {
          banner: '<%= banner %>',
          compress: true
        },
        files: {
          'js/<%= pkg.name %>.min.js': ['js/<%= pkg.name %>.js']
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-recess');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('dev', ['recess', 'concat']);
  grunt.registerTask('default', ['recess', 'concat', 'uglify']);

};