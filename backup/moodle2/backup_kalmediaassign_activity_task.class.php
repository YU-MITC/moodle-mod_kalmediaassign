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
 * @package    moodlecore
 * @subpackage backup-moodle2
 * @copyright  (C) 2010 onwards Eloy Lafuente (stronk7) {@link http://stronk7.com}
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
// Because it exists (must).
require_once(dirname(__FILE__) . '/backup_kalmediaassign_stepslib.php');
// Because it exists (optional).
require_once(dirname(__FILE__) . '/backup_kalmediaassign_settingslib.php');

if (!defined('MOODLE_INTERNAL')) {
    // It must be included from a Moodle page.
    die('Direct access to this script is forbidden.');
}

/**
 * kalmediaassign backup task that provides all the settings and steps to perform one
 * complete backup of the activity.
 */
class backup_kalmediaassign_activity_task extends backup_activity_task {

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
        // Choice only has one structure step.
        $this->add_step(new backup_kalmediaassign_activity_structure_step('kalmediaassign_structure', 'kalmediaassign.xml'));
    }

    /**
     * Code the transformations to perform in the activity in
     * order to get transportable (encoded) links.
     */
    static public function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, "/");

        // Link to the list of kalmediaassigns.
        $search = "/(".$base."\/mod\/kalmediaassign\/index.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@KALMEDIAASSIGNINDEX*$2@$', $content);

        // Link to kalmediaassign view by moduleid.
        $search = "/(".$base."\/mod\/kalmediaassign\/view.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@KALMEDIAASSIGNVIEWBYID*$2@$', $content);

        return $content;
    }
}
