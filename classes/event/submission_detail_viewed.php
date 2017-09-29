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
 * The submission_detail_viewed event.
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_kalmediaassign\event;
defined('MOODLE_INTERNAL') || die();

/**
 * Event class of YU Kaltura Media assign.
 *
 * @package   mod_kalmediaasign
 * @copyright (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class submission_detail_viewed extends \core\event\base {
    /**
     * This function set default value.
     * @access protected
     * @param none.
     * @return nothing.
     */
    protected function init() {
        // Select flags. c(reate), r(ead), u(pdate), d(elete).
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'kalmediaassign';
    }

    /**
     * This function return event name.
     * @access public
     * @param none.
     * @return string - event name.
     */
    public static function get_name() {
        return get_string('event_submission_detail_viewed', 'kalmediaassign');
    }

    /**
     * This function return description of submission.
     * @access public
     * @param none.
     * @return string - description of event.
     */
    public function get_description() {
        return "The user with id '{$this->userid}' viewed the submission detail of Kaltura media assign with "
        . "the course module id '{$this->contextinstanceid}'.";
    }

    /**
     * This function return object url.
     * @access public
     * @param none.
     * @return string - URL of target submission.
     */
    public function get_url() {
        return new \moodle_url('/mod/kalmediaassign/single_submission.php',
                               array('cmid' => $this->contextinstanceid,
                                     'userid' => $this->relateduserid,
                                     'sesskey' => sesskey()));
    }

    /**
     * This function return object url.
     * @access public
     * @param none.
     * @return array - log data.
     */
    public function get_legacy_logdata() {
        return array($this->courseid, 'kalmediaassign', 'view media submission detail',
            $this->get_url(), $this->objectid, $this->contextinstanceid);
    }
}