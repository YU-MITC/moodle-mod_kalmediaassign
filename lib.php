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
 * Kaltura media assignment library of hooks
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
// Include eventslib.php.
require_once($CFG->libdir.'/eventslib.php');
// Include calendar/lib.php.
require_once($CFG->dirroot.'/calendar/lib.php');

if (!defined('MOODLE_INTERNAL')) {
    // It must be included from a Moodle page.
    die('Direct access to this script is forbidden.');
}

require_login();

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $kalmediaassign - An object from the form in mod_form.php
 * @return int - The id of the newly inserted kalmediaassign record
 */
function kalmediaassign_add_instance($kalmediaassign) {
    global $DB;

    $kalmediaassign->timecreated = time();

    $kalmediaassign->id = $DB->insert_record('kalmediaassign', $kalmediaassign);

    if ($kalmediaassign->timedue) {
        $event = new stdClass();
        $event->name        = $kalmediaassign->name;
        $event->description = format_module_intro('kalmediaassign', $kalmediaassign, $kalmediaassign->coursemodule);
        $event->courseid    = $kalmediaassign->course;
        $event->groupid     = 0;
        $event->userid      = 0;
        $event->modulename  = 'kalmediaassign';
        $event->instance    = $kalmediaassign->id;
        $event->eventtype   = 'due';
        $event->timestart   = $kalmediaassign->timedue;
        $event->timeduration = 0;

        calendar_event::create($event);
    }

    kalmediaassign_grade_item_update($kalmediaassign);

    return $kalmediaassign->id;
}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $kalmediaassign - An object from the form in mod_form.php
 * @return boolean - Success/Fail
 */
function kalmediaassign_update_instance($kalmediaassign) {
    global $DB;

    $kalmediaassign->timemodified = time();
    $kalmediaassign->id = $kalmediaassign->instance;

    $updated = $DB->update_record('kalmediaassign', $kalmediaassign);

    if ($kalmediaassign->timedue) {
        $event = new stdClass();

        if ($event->id = $DB->get_field('event', 'id',
                                        array('modulename' => 'kalmediaassign', 'instance' => $kalmediaassign->id))) {

            $event->name        = $kalmediaassign->name;
            $event->description = format_module_intro('kalmediaassign', $kalmediaassign, $kalmediaassign->coursemodule);
            $event->timestart   = $kalmediaassign->timedue;

            $calendarevent = calendar_event::load($event->id);
            $calendarevent->update($event);
        } else {
            $event = new stdClass();
            $event->name        = $kalmediaassign->name;
            $event->description = format_module_intro('kalmediaassign', $kalmediaassign, $kalmediaassign->coursemodule);
            $event->courseid    = $kalmediaassign->course;
            $event->groupid     = 0;
            $event->userid      = 0;
            $event->modulename  = 'kalmediaassign';
            $event->instance    = $kalmediaassign->id;
            $event->eventtype   = 'due';
            $event->timestart   = $kalmediaassign->timedue;
            $event->timeduration = 0;

            calendar_event::create($event);
        }
    } else {
        $DB->delete_records('event', array('modulename' => 'kalmediaassign', 'instance' => $kalmediaassign->id));
    }

    if ($updated) {
        kalmediaassign_grade_item_update($kalmediaassign);
    }

    return $updated;
}


/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id - Id of the module instance
 * @return boolean - Success/Failure
 */
function kalmediaassign_delete_instance($id) {
    global $DB;

    $result = true;

    if (! $kalmediaassign = $DB->get_record('kalmediaassign', array('id' => $id))) {
        return false;
    }

    if (! $DB->delete_records('kalmediaassign_submission', array('mediaassignid' => $kalmediaassign->id))) {
        $result = false;
    }

    if (! $DB->delete_records('event', array('modulename' => 'kalmediaassign', 'instance' => $kalmediaassign->id))) {
        $result = false;
    }

    if (! $DB->delete_records('kalmediaassign', array('id' => $kalmediaassign->id))) {
        $result = false;
    }

    kalmediaassign_grade_item_delete($kalmediaassign);

    return $result;
}


/**
 * Return a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 * @param object $course - Moodle course object.
 * @param object $user - Moodle user object.
 * @param object $mod - Moodle moduble object.
 * @param object $kalmediaassign - An object from the form in mod_form.php.
 * @return object - outline of user.
 * @todo Finish documenting this function
 */
function kalmediaassign_user_outline($course, $user, $mod, $kalmediaassign) {
    $return = new stdClass;
    $return->time = 0;
    $return->info = ''; // TODO finish this function.
    return $return;
}


/**
 * Print a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 * @param object $course - Moodle course object.
 * @param object $user - Moodle user object.
 * @param object $mod - Moodle module obuject.
 * @param object $kalmediaassign - An object from the form in mod_form.php.
 * @return bool - this function always return true.
 * @todo Finish documenting this function
 */
function kalmediaassign_user_complete($course, $user, $mod, $kalmediaassign) {
    return true;  // TODO: finish this function.
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in kalmediaassign activities and print it out.
 * Return true if there was output, or false is there was none.
 * @param object $course - Moodle course object.
 * @param array $viewfullnames - fullnames of course.
 * @param int $timestart - timestamp.
 * @return boolean - True if anything was printed, otherwise false.
 * @todo Finish documenting this function
 */
function kalmediaassign_print_recent_activity($course, $viewfullnames, $timestart) {
    // TODO: finish this function.
    return false;  // True if anything was printed, otherwise false.
}


/**
 * Must return an array of users who are participants for a given instance
 * of kalmediaassign. Must include every user involved in the instance,
 * independient of his role (student, teacher, admin...). The returned objects
 * must contain at least id property. See other modules as example.
 *
 * @param int $kalmediaassignid - ID of an instance of this module
 * @return boolean|array - false if no participants, array of objects otherwise
 */
function kalmediaassign_get_participants($kalmediaassignid) {
    // TODO: finish this function.
    return false;
}


/**
 * This function returns if a scale is being used by one kalmediaassign
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $kalmediaassignid - id of an instance of this module
 * @param int $scaleid - id of scale.
 * @return mixed - now, this function anywhere returns "false".
 * @todo Finish documenting this function
 */
function kalmediaassign_scale_used($kalmediaassignid, $scaleid) {

    $return = false;

    return $return;
}

/**
 * Checks if scale is being used by any instance of kalmediaassign.
 * This function was added in 1.9
 *
 * This is used to find out if scale used anywhere
 * @param int $scaleid - id of scale.
 * @return bool - True if the scale is used by any kalmediaassign
 */
function kalmediaassign_scale_used_anywhere($scaleid) {
    global $DB;

    $param = array('grade' => -$scaleid);
    if ($scaleid and $DB->record_exists('kalmediaassign', $param)) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function returns support status about a feature which is received as argument.
 * @param string $feature - FEATURE_xx constant for requested feature
 * @return mixed - True if module supports feature, null if doesn't know
 */
function kalmediaassign_supports($feature) {
    switch($feature) {
        case FEATURE_GROUPS:
            return true;
        case FEATURE_GROUPINGS:
            return true;
        case FEATURE_GROUPMEMBERSONLY:
            return true;
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return true;
        case FEATURE_GRADE_HAS_GRADE:
            return true;
        case FEATURE_GRADE_OUTCOMES:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;

        default:
            return null;
    }
}

/**
 * Create/update grade item for given kaltura media assignment
 *
 * @param object $kalmediaassign - kalmediaassign object with extra cmidnumber
 * @param mixed $grades - optional array/object of grade(s); 'reset' means reset grades in gradebook
 * @return int - 0 if ok, error code otherwise
 */
function kalmediaassign_grade_item_update($kalmediaassign, $grades = null) {

    require_once(dirname(dirname(dirname(__FILE__))) . '/lib/gradelib.php');

    $params = array('itemname' => $kalmediaassign->name, 'idnumber' => $kalmediaassign->cmidnumber);

    if ($kalmediaassign->grade > 0) {
        $params['gradetype'] = GRADE_TYPE_VALUE;
        $params['grademax']  = $kalmediaassign->grade;
        $params['grademin']  = 0;

    } else if ($kalmediaassign->grade < 0) {
        $params['gradetype'] = GRADE_TYPE_SCALE;
        $params['scaleid']   = -$kalmediaassign->grade;

    } else {
        $params['gradetype'] = GRADE_TYPE_TEXT; // Allow text comments only.
    }

    if ($grades === 'reset') {
        $params['reset'] = true;
        $grades = null;
    }

    return grade_update('mod/kalmediaassign', $kalmediaassign->course, 'mod', 'kalmediaassign',
                        $kalmediaassign->id, 0, $grades, $params);

}

/**
 * Removes all grades from gradebook
 *
 * @param int $courseid - id of course.
 * @param string  $type - optional type.
 * @return nothing.
 */
function kalmediaassign_reset_gradebook($courseid, $type='') {
    global $DB;

    $sql = "SELECT l.*, cm.idnumber as cmidnumber, l.course courseid
              FROM {kalmediaassign} l, {course_modules} cm, {modules} m
             WHERE m.name='kalmediaassign' AND m.id=cm.module AND cm.instance=l.id AND l.course=:course";

    $params = array ('course' => $courseid);

    if ($kalvisassigns = $DB->get_records_sql($sql, $params)) {

        foreach ($kalvisassigns as $kalvisassign) {
            kalmediaassign_grade_item_update($kalvisassign, 'reset');
        }
    }

}


/**
 * Actual implementation of the reset course functionality, delete all the
 * kaltura media submissions attempts for course $data->courseid.
 *
 * @param object $data - the data submitted from the reset course.
 * @return array - status array.
 *
 * TODO: test user data reset feature
 */
function kalmediaassign_reset_userdata($data) {
    global $DB;

    $componentstr = get_string('modulenameplural', 'kalmediaassign');
    $status = array();

    if (!empty($data->reset_kalmediaassign)) {
        $kalmediaassignsql = "SELECT l.id
                           FROM {kalmediaassign} l
                           WHERE l.course=:course";

        $params = array ("course" => $data->courseid);
        $DB->delete_records_select('kalmediaassign_submission', "mediaassignid IN ($kalmediaassignsql)", $params);

        // Remove all grades from gradebook.
        if (empty($data->reset_gradebook_grades)) {
            kalmediaassign_reset_gradebook($data->courseid);
        }

        $status[] = array('component' => $componentstr,
                          'item' => get_string('deleteallsubmissions', 'kalmediaassign'),
                          'error' => false);
    }

    // Updating dates - shift may be negative too.
    if ($data->timeshift) {
        shift_course_mod_dates('kalmediaassign',
                               array('timedue', 'timeavailable'),
                               $data->timeshift, $data->courseid);
        $status[] = array('component' => $componentstr,
                          'item' => get_string('datechanged'),
                          'error' => false);
    }

    return $status;
}

/**
 * This function deeltes a grade item.
 *
 * @param object $kalmediaassign - kaltura media assignment object.
 * @return array - status array.
 *
 * TODO: test user data reset feature
 */
function kalmediaassign_grade_item_delete($kalmediaassign) {
    global $CFG;
    require_once($CFG->libdir . '/gradelib.php');

    return grade_update('mod/kalmediaassign', $kalmediaassign->course, 'mod', 'kalmediaassign', $kalmediaassign->id, 0,
            null, array('deleted' => 1));
}


/**
 * Function to be run periodically according to the moodle cron.
 * Finds all assignment notifications that have yet to be mailed out, and mails them.
 */
function kalmediaassign_cron () {
    return false;
}

/**
 * Return list of marked submissions that have not been mailed out for currently enrolled students
 *
 * @param int $starttime - start time for search submissions.
 * @param int $endtime - end time for search submissions.
 * @return array - list of marked submissions.
 */
function kalmediaassign_get_unmailed_submissions($starttime, $endtime) {

    global $DB;

    return $DB->get_records_sql("SELECT ks.*, k.course, k.name
                                     FROM {kalmediaassign_submission} ks,
                                     {kalmediaassign} k
                                     WHERE ks.mailed = 0
                                     AND ks.timemarked <= ?
                                     AND ks.timemarked >= ?
                                     AND ks.assignment = k.id", array($endtime, $starttime));
}