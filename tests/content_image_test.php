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

namespace contenttype_image;

/**
 * Tests for image content bank plugin content handling.
 *
 * @package    contenttype_image
 * @category   test
 * @copyright  2026 Moodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \contenttype_image\content
 */
final class content_image_test extends \advanced_testcase {
    /**
     * Tests importing a valid image file.
     *
     * @covers ::import_file
     */
    public function test_import_file_accepts_valid_image(): void {
        global $CFG;

        $this->resetAfterTest();
        $this->setAdminUser();

        $contenttype = new contenttype(\context_system::instance());
        $content = $contenttype->create_content((object) ['name' => 'logo.png']);

        $draftfile = $this->create_draft_file_from_path($CFG->dirroot . '/privacy/tests/fixtures/logo.png');
        $storedfile = $content->import_file($draftfile);

        if (!($storedfile instanceof \stored_file)) {
            throw new \Exception('Expected imported file to be a stored_file instance.');
        }
        if ($storedfile->get_filename() !== 'logo.png') {
            throw new \Exception('Expected uploaded file name to be preserved.');
        }
        if (!$storedfile->is_valid_image()) {
            throw new \Exception('Imported file should be a valid web image.');
        }
    }

    /**
     * Tests importing an invalid non-image file.
     *
     * @covers ::import_file
     */
    public function test_import_file_rejects_invalid_file(): void {
        global $CFG;

        $this->resetAfterTest();
        $this->setAdminUser();

        $contenttype = new contenttype(\context_system::instance());
        $content = $contenttype->create_content((object) ['name' => 'provider_a.php']);

        $draftfile = $this->create_draft_file_from_path($CFG->dirroot . '/privacy/tests/fixtures/provider_a.php');

        try {
            $content->import_file($draftfile);
            throw new \Exception('Expected moodle_exception was not thrown.');
        } catch (\moodle_exception $e) {
            if ($e->errorcode !== 'notvalidimage') {
                throw new \Exception('Unexpected moodle_exception errorcode: ' . $e->errorcode);
            }
        }
    }

    /**
     * Create a draft file from a path.
     *
     * @param string $path Absolute path to an existing file.
     * @return \stored_file
     */
    private function create_draft_file_from_path(string $path): \stored_file {
        global $USER;

        $draftitemid = file_get_unused_draft_itemid();
        $fs = get_file_storage();
        $usercontext = \context_user::instance($USER->id);

        $filerecord = [
            'contextid' => $usercontext->id,
            'component' => 'user',
            'filearea' => 'draft',
            'itemid' => $draftitemid,
            'filepath' => '/',
            'filename' => basename($path),
        ];

        return $fs->create_file_from_pathname($filerecord, $path);
    }
}
