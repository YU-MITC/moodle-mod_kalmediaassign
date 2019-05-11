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
 * Language file of YU Kaltura media assignment.
 *
 * @package    mod_kalmediaassign
 * @copyright  (C) 2016-2019 Yamaguchi University <gh-cc@mlex.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulenameplural'] = 'Kalturaメディア課題';
$string['modulename'] = 'Kalturaメディア課題';
$string['modulename_help'] = 'Kalturaメディア課題により、教師は学生にKalturaメディアのアップロードと提出を要求する課題を作成することができます。教師は学生の提出物に対して評定とフィードバックを付与することができます。';
$string['gradingsummary'] = '評定概要';
$string['submissionstatus'] = '提出ステータス';
$string['gradingstatus'] = '評定ステータス';
$string['name'] = '課題名';
$string['description'] = '説明';
$string['availabledate'] = '開始日時';
$string['duedate'] = '終了日時';
$string['alwaysshowdescription'] = '常に説明を表示する。';
$string['alwaysshowdescription_help'] = '無効に設定した場合、上記の説明は開始日時以降に学生に公開されます。';
$string['submissionsettings_hdr'] = '提出設定';
$string['preventlate'] = '終了日時以降の提出を許可する';
$string['allowdeleting'] = '再提出を許可する';
$string['allowdeleting_help'] = '有効に設定した場合、学生は提出済みのメディアを置き換える可能性があります。終了日時以降に提出が可能かどうかは「終了日以降の提出を許可する」の設定によります。';
$string['emailteachers'] = '教師へのメール通知';
$string['emailteachers_help'] = '有効に設定した場合、学生が提出物を追加するたびに教師は電子メールを受信します。その課題を採点可能な教師だけが通知を受け取ります。従って、コース分離グループを使用している場合、特定のグループの採点にのみ制限されている教師は、他のグループの学生についての通知を受け取りません。';
$string['invalidid'] = '不正なID';
$string['pluginadministration'] = 'Kalturaメディア課題';
$string['add_media'] = 'メディアの追加';
$string['submit_media'] = 'メディアの提出';
$string['replace_media'] = 'メディアの変更';
$string['previewmedia'] = 'プレビュー';
$string['gradesubmission'] = 'すべての課題を表示/評定する';
$string['numberofmembers'] = '参加者数';
$string['numberofsubmissions'] = '提出数';
$string['numberofrequiregrading'] = '要評定';
$string['assignmentexpired'] = '提出が中断されました。課題の終了日時が到来しています。';
$string['assignmentsubmitted'] = 'あなたの課題が提出されました。';
$string['emptyentryid'] = '課題が正常に提出されませんでした。再度提出してください。';
$string['deleteallsubmissions'] = 'すべての課題を削除する';
$string['fullname'] = '氏名';
$string['grade'] = '評定';
$string['gradedby'] = '評定者';
$string['gradedon'] = '評定日時';
$string['feedbackcomment'] = 'フィードバックコメント';
$string['currentgrade'] = '現在の評定';
$string['submissioncomment'] = 'コメント';
$string['timemodified'] = '最終更新日時 (提出)';
$string['grademodified'] = '最終更新日時 (評定)';
$string['finalgrade'] = '最終評定';
$string['status'] = 'ステータス';
$string['optionalsettings'] = 'オプション設定';
$string['savepref'] = '設定を保存';
$string['all'] = 'すべて';
$string['reqgrading'] = '要評定';
$string['submitted'] = '提出済み';
$string['notsubmittedyet'] = '未提出';
$string['pagesize'] = '1ページあたりの課題数';
$string['pagesize_help'] = '1ページあたりに表示される課題数を設定する。';
$string['show'] = '表示';
$string['show_help'] = "「すべて」が選択されている場合、未提出者も含めたすべての学生が表示されます。「要評定」が選択されている場合、未評定の課題もしくは評定後に更新された課題のみが表示されます。「提出済み」が選択されている場合、メディア課題を提出した学生のみが表示されます。";
$string['quickgrade'] = 'クイック評定を許可';
$string['quickgrade_help'] = '有効に設定した場合、1ページにおいて複数の課題の評定が可能です。評定とコメントを加えた後に、「フィードバックを保存」をクリックしてください。';
$string['invalidperpage'] = 'ゼロより大きな値を入力してください。';
$string['savefeedback'] = '評定とフィードバックを保存';
$string['submission'] = '提出';
$string['grades'] = '評定';
$string['feedback'] = 'フィードバック';
$string['singlesubmissionheader'] = '評定';
$string['singlegrade'] = 'Add help text';
$string['singlegrade_help'] = 'Add help text';
$string['late'] = '期限より {$a} 遅れて提出されました';
$string['early'] = '期限より {$a} 早く提出されました';
$string['lastgrade'] = '前回の評点';
$string['savedchanges'] = '変更が保存されました';
$string['save'] = '変更を保存';
$string['cancel'] = 'キャンセル';
$string['checkconversionstatus'] = 'メディアの変換状況を確認してください。';
$string['pluginname'] = 'Kalturaメディア課題';
$string['media_converting'] = 'メディアはまだ変換中です。後でメディアの状況を確認してください。';
$string['emailteachermail'] = '{$a->username} は課題 {$a->assignment} を {$a->timeupdated} に更新しました。

提出された課題のURLはこちらです。

    {$a->url}';
$string['emailteachermailhtml'] = '{$a->username} は課題 <i>${$a->assignment}を {$a->timeupdated} に更新しました</i>。
<br /><br />
提出された課題のURLは<a href="{$a->url}">こちら</a>です。';
$string['messageprovider:kalmediaassign_updates'] = 'Kalturaメディア課題の通知';
$string['media_preview_header'] = '課題のプレビュー';
$string['kalmediaassign:gradesubmission'] = 'メディア課題の評定';
$string['kalmediaassign:addinstance'] = 'メディア課題の追加';
$string['kalmediaassign:submit'] = '課題の提出';
$string['grade_media_not_cache'] = 'このメディアはまだ変換処理の途中です。';
$string['noenrolledstudents'] = 'このコースには参加者がいません';
$string['group_filter'] = 'グループフィルタ';
$string['scr_loading'] = '読み込み中です。';
$string['reviewmedia'] = '課題のレビュー';
$string['kalmediaassign:screenrecorder'] = 'スクリーン・レコーダ';
$string['cannotdisplaythumbnail'] = 'サムネイルを表示できません';
$string['noassignments'] = 'コース内でKalturaメディアが見つかりません';
$string['table_failed'] = 'エラーによりテーブルを表示できません。';
$string['submitted'] = '提出済み';
$string['nosubmission'] = '提出無し';
$string['nosubmissions'] = '提出無し';
$string['status_nosubmission'] = '未提出';
$string['status_submitted'] = '評定のために提出済み';
$string['status_marked'] = '評定済み';
$string['status_nomarked'] = '未評定';
$string['status_timemodified'] = '最終更新';
$string['submissionnotopened'] = '開始前';
$string['submissionexpired'] = '終了日時が到来しました';
$string['latesubmission'] = '遅延';
$string['submissionclosed'] = '終了';
$string['remainingtime'] = '残り時間';
$string['not_insert'] = '提出データの挿入に失敗しました。';
$string['not_update'] = '提出データの更新に失敗しました。';
$string['event_submission_page_viewed'] = 'メディア提出ページが表示されました';
$string['event_submission_detail_viewed'] = 'メディア提出の詳細が表示されました';
$string['event_grades_updated'] = 'メディアの評定が更新されました';
$string['event_media_submitted'] = 'メディアが提出されました。';
$string['reset_userdata'] = 'すべての提出を削除する';
$string['outlinegrade'] = '評定: {$a}';
