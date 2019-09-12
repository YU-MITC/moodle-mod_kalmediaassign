<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Restore activity script.
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  (C) 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @copyright  (C) 2016-2019 Yamaguchi University <gh-cc@mlex.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Because it exists (must).
require_once(dirname(__FILE__) . '/restore_kalmediaassign_stepslib.php');

/**
 * kalmediaassign restore task.
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  (C) 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @copyright  (C) 2016-2019 Yamaguchi University <gh-cc@mlex.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_kalmediaassign_activity_task extends restore_activity_task {

    /**
     * Define (add) particular settings this activity can have.
     */
    protected function define_my_settings() {
        // No particular settings for this activity.
    }

    /**
     * Define (add) particular steps this activity can have.
     */
    protected function define_my_steps() {
        // Certificate only has one structure step.
        $this->add_step(new restore_kalmediaassign_activity_structure_step('kalmediaassign_structure', 'kalmediaassign.xml'));
    }

    /**
     * Define the contents in the activity that must be
     * processed by the link decoder.
     * @return object - decoded content.
     */
    static public function define_decode_contents() {
        $contents = array();

        $contents[] = new restore_decode_content('kalmediaassign', array('intro'), 'kalmediaassign');

        return $contents;
    }

    /**
     * Define the decoding rules for links belonging
     * to the activity to be executed by the link decoder.
     * @return array - list of rule.
     */
    static public function define_decode_rules() {
        $rules = array();

        $rules[] = new restore_decode_rule('KALMEDIAASSIGNVIEWBYID', '/mod/kalmediaassign/view.php?id=$1', 'course_module');
        $rules[] = new restore_decode_rule('KALMEDIAASSIGNINDEX', '/mod/kalmediaassign/index.php?id=$1', 'course_module');

        return $rules;

    }

    /**
     * Define the restore log rules that will be applied
     * by the {@link restore_logs_processor} when restoring
     * kalmediaassign logs. It must return one array
     * of {@link restore_log_rule} objects.
     * @return array - list of rule.
     */
    static public function define_restore_log_rules() {
        $rules = array();

        $rules[] = new restore_log_rule('kalmediaassign', 'add', 'view.php?id={course_module}', '{kalmediaassign}');
        $rules[] = new restore_log_rule('kalmediaassign', 'update', 'view.php?id={course_module}', '{kalmediaassign}');
        $rules[] = new restore_log_rule('kalmediaassign', 'view', 'view.php?id={course_module}', '{kalmediaassign}');

        return $rules;
    }

    /**
     * Define the restore log rules that will be applied
     * by the {@link restore_logs_processor} when restoring
     * course logs. It must return one array
     * of {@link restore_log_rule} objects.
     *
     * Note this rules are applied when restoring course logs
     * by the restore final task, but are defined here at
     * activity level. All them are rules not linked to any module instance (cmid = 0).
     *
     * @return array - list of rule.
     */
    static public function define_restore_log_rules_for_course() {
        $rules = array();

        // Fix old wrong uses (missing extension).
        $rules[] = new restore_log_rule('kalmediaassign', 'view all', 'index.php?id={course}', null);

        return $rules;
    }
}
