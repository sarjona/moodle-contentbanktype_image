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
 * Image content bank manager class.
 *
 * @package    contenttype_image
 * @copyright  2026 Moodle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class contenttype extends \core_contentbank\contenttype {
    /**
     * Returns the HTML code to render the icon for image content types.
     *
     * @param \core_contentbank\content $content The content to be displayed.
     * @return string
     */
    public function get_icon(\core_contentbank\content $content): string {
        global $OUTPUT;

        $file = $content->get_file();
        if (!empty($file)) {
            return $OUTPUT->image_url(file_file_icon($file))->out(false);
        }

        return $OUTPUT->image_url('f/image')->out(false);
    }

    /**
     * Returns the HTML content to add to view.php visualizer.
     *
     * @param \core_contentbank\content $content The content to be displayed.
     * @return string
     */
    public function get_view_content(\core_contentbank\content $content): string {
        $fileurl = $content->get_file_url();
        if (empty($fileurl)) {
            return '';
        }

        $attributes = [
            'src' => $fileurl,
            'alt' => $content->get_name(),
            'class' => 'img-fluid',
            'loading' => 'lazy',
        ];
        $customfields = parent::get_view_content($content);

        return \html_writer::empty_tag('img', $attributes) . $customfields;
    }

    /**
     * Return an array of implemented features by this plugin.
     *
     * @return array
     */
    protected function get_implemented_features(): array {
        return [self::CAN_UPLOAD, self::CAN_DOWNLOAD, self::CAN_COPY];
    }

    /**
     * Return an array of extensions this contenttype can manage.
     *
     * @return array
     */
    public function get_manageable_extensions(): array {
        return ['.gif', '.jpg', '.jpeg', '.png'];
    }

    /**
     * Returns the list of different image content creation types.
     *
     * Image content is upload-only, so no editor creation options are returned.
     *
     * @return array
     */
    public function get_contenttype_types(): array {
        return [];
    }
}
