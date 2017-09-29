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
 * Moodle course unit test for Kaltura
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2008-2014 Remote-Learner Inc <http://www.remote-learner.net>
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/mod/kalmediaassign/locallib.php');

if (!defined('MOODLE_INTERNAL')) {
    // It must be included from a Moodle page.
    die('Direct access to this script is forbidden.');
}

/**
 * Class of Moodle course unit test.
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2008-2014 Remote-Learner Inc <http://www.remote-learner.net>
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class locallib_testcase extends advanced_testcase {
    /**
     * This function tests output from kalmediaassign_get_player_dimensions().
     * @access public
     * @param none.
     * @return nothing.
     */
    public function test_kalmediaassign_get_player_dimensions_return_defaults() {
        $this->resetAfterTest(true);

        $result = kalmediaassign_get_player_dimensions();

        $this->assertCount(2, $result);
        $this->assertEquals(400, $result[0]);
        $this->assertEquals(365, $result[1]);
    }

    /**
     * This function tests output from kalmediaassign_get_player_dimensions().
     * @access public
     * @param none.
     * @return nothing.
     */
    public function test_kalmediaassign_get_player_dimensions_return_configured_results() {
        $this->resetAfterTest(true);

        set_config('kalmediaassign_player_width', 500, 'local_yukaltura');
        set_config('kalmediaassign_player_height', 500, 'local_yukaltura');

        $result = kalmediaassign_get_player_dimensions();

        $this->assertCount(2, $result);
        $this->assertEquals('500', $result[0]);
        $this->assertEquals('500', $result[1]);
    }

    /**
     * This function tests output from kalmediaassign_get_player_dimensions().
     * @access public
     * @param none.
     * @return nothing.
     */
    public function test_kalmediaassign_get_player_dimensions_return_default_results_when_empty() {
        $this->resetAfterTest(true);

        $result = kalmediaassign_get_player_dimensions();

        set_config('kalmediaassign_player_width', '', 'local_yukaltura');
        set_config('kalmediaassign_player_height', '', 'local_yukaltura');
        $this->assertCount(2, $result);
        $this->assertEquals(400, $result[0]);
        $this->assertEquals(365, $result[1]);
    }
}
