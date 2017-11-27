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
 * YU Kaltura Media Assignment verison file.
 * @package    mod_kalmediaassign
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'mod_kalmediaassign';
$plugin->version = 2017112700;
$plugin->release = 'YU Kaltura Media Assignment 1.1.0';
$plugin->requires = 2015051100;
$plugin->maturity = MATURITY_STABLE;
$plugin->cron = 0;
$plugin->dependencies = array(
    'local_yukaltura' => 2017112700,
    'local_yumymedia' => 2017112700
);