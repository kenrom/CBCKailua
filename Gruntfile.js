/**
 * CBCKailua
 * https://github.com/kenrom/CBCKailua/
 * Copyright (c) 2015 Ken Romero
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    site: grunt.file.readYAML('_config.yml'),

    jshint: {
      all: ['Gruntfile.js', 'js/app.js', 'test/*.js'],
      options: {
        jshintrc: '.jshintrc',
        globals: {
          $: false
        }
      },
      
    },


    // Before generating any new files,
    // remove any previously-created files.
    clean: {
      example: ['<%= site.destination %>/*.html']
    },

    nodeunit: {
      files: ['test/test-*.js']
    },

    watch: {
      jshint: {
        files: ['<%= jshint.all %>'],
        tasks: ['jshint:lint']
      }
    }
  });

  // Load npm plugins to provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-nodeunit');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // Tests to be run.
  grunt.registerTask('test', ['nodeunit']);

  // Default to tasks to run with the "grunt" command.
  grunt.registerTask('default', ['clean', 'jshint', 'test', 'watch']);
};
