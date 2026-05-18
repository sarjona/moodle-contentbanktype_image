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
 * Image content manager class.
 *
 * @package    contenttype_image
 * @copyright  2026 Moodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace contenttype_image;

/**
 * Image content manager class.
 *
 * @package    contenttype_image
 * @copyright  2026 Moodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class content extends \core_contentbank\content {
    /**
     * Import a file as a valid content.
     *
     * @param \stored_file $file File to store in the content file area.
     * @return \stored_file|null
     * @throws \moodle_exception If the file is not a valid image.
     */
    public function import_file(\stored_file $file): ?\stored_file {
        $filename = strtolower($file->get_filename());
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedextensions = ['gif', 'jpg', 'jpeg', 'png'];

        if (!in_array($extension, $allowedextensions, true) || !$file->is_valid_image()) {
            throw new \moodle_exception('notvalidimage', 'contenttype_image');
        }

        return parent::import_file($file);
    }
}
