"use strict"

module.exports = (grunt) ->

  grunt.initConfig

    pkg: grunt.file.readJSON 'package.json'

    coffeelint:
      scripts:
        options:
          globals: ['jQuery', 'google', 'window', 'console']
        src: ['src/<%= pkg.name %>.coffee']
      config:
        options:
          globals: ['module']
        src: ['Gruntfile.coffee']

    coffee:
      compile:
        options:
          bare: true
        src: ['src/<%= pkg.name %>.coffee']
        dest: 'dist/<%= pkg.name %>.js'

    uglify:
      dist:
        options:
          compress: true
        src: ['<%= coffee.compile.dest %>']
        dest: 'dist/<%= pkg.name %>.min.js'

    watch:
      scripts:
        files: ['src/access-map.coffee'],
        tasks: ['default'],
      config:
        files: ['Gruntfile.coffee'],
        tasks: ['coffeelint:config', 'default']

  [
    'grunt-coffeelint',
    'grunt-contrib-coffee',
    'grunt-contrib-uglify',
    'grunt-contrib-watch'
  ].forEach (task) ->
    grunt.loadNpmTasks task

  grunt.registerTask 'default', ['coffeelint', 'coffee', 'uglify']
