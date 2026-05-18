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
 * Tests for image content bank plugin content type.
 *
 * @package    contenttype_image
 * @category   test
 * @copyright  2026 Moodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @coversDefaultClass \contenttype_image\contenttype
 */
final class contenttype_image_test extends \advanced_testcase {
    /**
     * Tests feature declarations and manageable extensions.
     *
     * @covers ::is_feature_supported
     * @covers ::get_manageable_extensions
     */
    public function test_supported_features_and_extensions(): void {
        $this->resetAfterTest();

        $contenttype = new contenttype(\context_system::instance());

        if (!$contenttype->is_feature_supported(contenttype::CAN_UPLOAD)) {
            throw new \Exception('Image content type must support upload.');
        }
        if (!$contenttype->is_feature_supported(contenttype::CAN_DOWNLOAD)) {
            throw new \Exception('Image content type must support download.');
        }
        if (!$contenttype->is_feature_supported(contenttype::CAN_COPY)) {
            throw new \Exception('Image content type must support copy.');
        }
        if ($contenttype->is_feature_supported(contenttype::CAN_EDIT)) {
            throw new \Exception('Image content type must not support editor content creation.');
        }

        if ($contenttype->get_manageable_extensions() !== ['.gif', '.jpg', '.jpeg', '.png']) {
            throw new \Exception('Unexpected manageable extensions returned.');
        }
    }

    /**
     * Tests can_upload behavior.
     *
     * @covers ::can_upload
     */
    public function test_can_upload(): void {
        $this->resetAfterTest();

        $systemcontext = \context_system::instance();
        $systemtype = new contenttype($systemcontext);

        // Admins can upload.
        $this->setAdminUser();
        if (!$systemtype->can_upload()) {
            throw new \Exception('Admin should be able to upload images.');
        }

        // Teacher can upload in the course but not at system level.
        $course = $this->getDataGenerator()->create_course();
        $teacher = $this->getDataGenerator()->create_and_enrol($course, 'editingteacher');
        $coursecontext = \context_course::instance($course->id);
        $coursetype = new contenttype($coursecontext);
        $this->setUser($teacher);
        if (!$coursetype->can_upload()) {
            throw new \Exception('Teacher should be able to upload images in course context.');
        }
        if ($systemtype->can_upload()) {
            throw new \Exception('Teacher should not be able to upload images at system context.');
        }

        // Regular users cannot upload.
        $user = $this->getDataGenerator()->create_user();
        $this->setUser($user);
        if ($coursetype->can_upload()) {
            throw new \Exception('Regular users should not upload images in course context.');
        }
        if ($systemtype->can_upload()) {
            throw new \Exception('Regular users should not upload images in system context.');
        }
    }
}
