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
 * @package    moodlecore_backup-moodle2
 * @copyright  (C) 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');

if (!defined('MOODLE_INTERNAL')) {
    // It must be included from a Moodle page.
    die('Direct access to this script is forbidden.');
}

/**
 * Define all the restore steps that will be used by the restore_kalmediaassign_activity_task
 */

/**
 * Structure step to restore one kalmediaassign activity.
 *
 * @package    moodlecore_backup-moodle2
 * @copyright  (C) 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_kalmediaassign_activity_structure_step extends restore_activity_structure_step {

    /**
     * Define (add) particular settings this activity can have.
     * @access protected
     * @param none.
     * @return object - define structure.
     */
    protected function define_structure() {

        $paths = array();
        $userinfo = $this->get_setting_value('userinfo');

        $paths[] = new restore_path_element('kalmediaassign', '/activity/kalmediaassign');

        if ($userinfo) {
            $paths[] = new restore_path_element('kalmediaassign_submission', '/activity/kalmediaassign/submissions/submission');
        }

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Define (add) particular settings this activity can have.
     * @access protected
     * @param object $data - array of data.
     * @return object - kalmediaassign instance.
     */
    protected function process_kalmediaassign($data) {
        global $DB;

        $data = (object)$data;
        $data->course = $this->get_courseid();

        $data->timemodified = $this->apply_date_offset($data->timemodified);

        // Insert the kalmediaassign record.
        $newitemid = $DB->insert_record('kalmediaassign', $data);
        // Immediately after inserting "activity" record, call this.
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Restore kalmediaassign.
     * @access protected
     * @param array $data - structure defines.
     * @return object nothing.
     */
    protected function process_kalmediaassign_submission($data) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        $data->mediaassignid = $this->get_new_parentid('kalmediaassign');
        $data->userid = $this->get_mappingid('user', $data->userid);
        $data->timecreated = $this->apply_date_offset($data->timecreated);

        $newitemid = $DB->insert_record('kalmediaassign_submission', $data);
        $this->set_mapping('kalmediaassign_submission', $oldid, $newitemid);
    }

    /**
     * Restore related files.
     * @access protected
     * @param none.
     * @return nothing.
     */
    protected function after_execute() {
        // Add kalmediaassign related files, no need to match by itemname (just internally handled context).
        $this->add_related_files('mod_kalmediaassign', 'submission', 'kalmediaassign_submission');
    }
}
