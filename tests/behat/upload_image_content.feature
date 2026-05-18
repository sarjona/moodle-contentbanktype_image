@core @core_contentbank @contenttype_image @_file_upload @javascript
Feature: Upload image files to content bank
  In order to reuse image assets in learning activities
  As a teacher
  I need to be able to upload image files to the course content bank

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1        | 0        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following "user private file" exists:
      | user     | teacher1                       |
      | filepath | privacy/tests/fixtures/logo.png |
    And I log in as "teacher1"

  Scenario: Teacher uploads a PNG image in course content bank
    Given I am on "Course 1" course homepage with editing mode on
    And the following config values are set as admin:
      | unaddableblocks | | theme_boost|
    And I add the "Navigation" block if not present
    When I expand "Site pages" node
    And I click on "Content bank" "link"
    And I click on "Upload" "link"
    And I click on "Choose a file..." "button"
    And I click on "Private files" "link" in the ".fp-repo-area" "css_element"
    And I click on "logo.png" "link"
    And I click on "Select this file" "button"
    And I click on "Save changes" "button"
    Then I should see "logo.png"
