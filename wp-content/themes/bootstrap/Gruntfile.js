"use strict";

module.exports = function (grunt) {

  [
    'grunt-contrib-less',
    'grunt-contrib-jshint',
    'grunt-contrib-uglify',
    'grunt-contrib-watch'
  ].forEach(function (task) {
    grunt.loadNpmTasks(task);
  });

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
          compress: true,
          sourceMap: true,
          sourceMapFilename: 'css/main.min.css.map',
          sourceMapBasepath: 'css'
        },
        src: ['less/main.less'],
        dest: 'css/main.min.css'
      }
    },

    jshint: {
      options: {
        globals: {
          window: false,
          console: false,
          jQuery: false
        },
        jshintrc: '.jshintrc'
      },
      scripts: {
        src: [
          'js/*',
          '!js/main.min.js',
          '!js/dropdown.js'
        ]
      },
      config: {
        src: ['Gruntfile.js']
      }
    },

    uglify: {
      dist: {
        options: {
          banner: '<%= banner %>',
          compress: true,
          sourceMap: true
        },
        src: [
          'vendor/bootstrap/js/transition.js',
          'vendor/bootstrap/js/alert.js',
          // 'vendor/bootstrap/js/button.js',
          'vendor/bootstrap/js/carousel.js',
          // 'vendor/rygine/looper/src/looper.js',
          'vendor/bootstrap/js/collapse.js',
          'vendor/bootstrap/js/dropdown.js',
          // 'vendor/bootstrap/js/modal.js',
          // 'vendor/bootstrap/js/tooltip.js',
          // 'vendor/bootstrap/js/popover.js',
          // 'vendor/bootstrap/js/scrollspy.js',
          // 'vendor/bootstrap/js/tab.js',
          // 'vendor/bootstrap/js/affix.js',
          // 'vendor/jquery.scrollTo/jquery.scrollTo.js',
          'vendor/cover/src/cover.js',
          // 'js/single-page.js',
          // 'js/bootstrap-gravity-forms.js',
          'js/js.js'
        ],
        dest: 'js/main.min.js'
      }
    },

    watch: {
      styles: {
        files: ['less/*.less'],
        tasks: ['less']
      },
      scripts: {
        files: ['js/*.js', '!<%= uglify.dist.dest %>'],
        tasks: ['jshint', 'uglify']
      },
      config: {
        files: ['Gruntfile.js'],
        tasks: ['default'],
        options: {
          reload: true
        }
      }
    }
  });

  grunt.registerTask('default', ['less', 'jshint', 'uglify']);

};