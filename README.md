# YU Kaltura Media Package
"YU Kaltura Media Package" is a third-party's Kaltura plugin package for Moodle 2.9 or later. This package is developed by the Media and Information Technology Center, Yamaguchi University. By using this package, users can upload media to the Kaltura server, and easily embed the media in Moodle courses. Moreover, this package provides some useful functions. Since this package does not require Kaltura Application Framework (KAF), can work with Kaltura Community Edition (CE) and other editions.

Please note that there is a chance this module will not work on some Moodle environment. Also, this package is only available in English. Stay tuned to future versions for other language supports.

Original plugin package ("Kaltura Video Package") has better functions than ours and is easy to use. So that, for customers of the "Kaltura SaaS Edition", use the original plugin package is the better.

YU Kaltura Media Assign for Moodle
------
This is an activity module. Each student can submit a media from their "My Media", and teachers can play submitted medias, and grade each media.
This plugin is updated with stable releases. To follow active development on GitHub, click [here](https://github.com/YU-MITC/moodle-mod_kalmediaassign/).

Requirements
------

* PHP5.6 or greater.
* Web browsers must support the JavaScript and HTML5.
* "local_yukaltura" and "local_yumymedia" plugins.

Installation
------

Unzip this plugin, and copy the directory (mod/kalmediaasign) under moodle root directory (ex. /moodle).
Installation will be completed after you log in as an administrator and access the notification menu.

How to use
------

User's guide, click [here](http://www.cc.yamaguchi-u.ac.jp/guides/cas/plugins/userguide_version1.1.pdf).

Now, we wrote sections about installation, initial configuration and summary of "My Media".

Rest sections will be written soon...

Targeted Moodle versions
------

Moodle 2.9, 3.0, 3.1, 3.2, 3.3, 3.4

Branches
------

* MOODLE_29_STABLE -> Moodle2.9 branch 
* MOODLE_30_STABLE -> Moodle3.0 branch 
* MOODLE_31_STABLE -> Moodle3.1 branch 
* MOODLE_32_STABLE -> Moodle3.2 branch 
* MOODLE_33_STABLE -> Moodle3.3 branch 
* MOODLE_34_STABLE -> Moodle3.4 branch 

First clone the repository with "git clone", then "git checkout MOODLE_29_STABLE(branch name)" to switch branches.

Warning
------

* We are not responsible for any problem caused by this software. 
* This software follows the license policy of Moodle (GNU GPL v3).
* "Kaltura" is the registered trademark of the Kaltura Inc.
* Web-camera recording function in "My Media" supports the Mozilla Firefox, Google chrome, Opera and Safari. For smartphones and tablets, you can record movie through a normal media uploader.
