# Moodle Content Bank image plugin (demo)

This repository contains a prototype Moodle content bank plugin for Moodle. It was developed as a live proof-of-concept for MoodleMoot Euskadi 2026 to demonstrate how artificial intelligence can [des]accelerate Moodle plugin development.

The plugin introduces a new content type to the Moodle content bank, specifically designed to help learning designers and teachers centralise, manage, and reuse course imagery efficiently.

## 🎮 Try in Moodle Playground

Click the badge below to open the `main` branch instantly in Moodle Playground
with the plugin pre-installed, an "Image Demo" course already created, and a
sample `logo.png` uploaded into the system content bank so you can preview
the image content type right away. Every pull request automatically generates
a playground preview link appended to the PR description, so reviewers can
test the changes in a live Moodle instance without any local setup.

<a href="https://moodle-playground.com/?blueprint-url=https://raw.githubusercontent.com/sarjona/moodle-contentbanktype_image/refs/heads/main/blueprint.json" target="_blank" rel="noopener"><img src="https://raw.githubusercontent.com/ateeducacion/action-moodle-playground-pr-preview/refs/heads/main/assets/playground-preview-button.svg" alt="Preview in Moodle Playground" width="200"></a>

The PR preview links are produced by the
<a href="https://github.com/ateeducacion/action-moodle-playground-pr-preview" target="_blank" rel="noopener">ateeducacion/action-moodle-playground-pr-preview</a>
GitHub Action, configured via `blueprint.json` at the repository root.

## 🚀 Purpose

In standard Moodle workflows, managing course images can sometimes lead to duplication or scattered files. This plugin utilises the Moodle content bank API to create a dedicated repository for visual assets within a course context.

Because this project was built using AI generation tools, it serves dual purposes:

- Functional: A practical tool for educators to streamline media management.
- Educational: A showcase of how AI can scaffold, write, and structure Moodle-compliant plugin code.

## ✨ Features

- Direct upload: Easily drop images directly into the Moodle content bank.
- Centralised reuse: Access uploaded images seamlessly across different activities, labels, and pages within the same course.
- Optimised UI: A clean interface tailored specifically for quick image management, bypassing generic file-picker friction.
- AI-Scaffolded: Built leveraging modern AI coding assistants to demonstrate prototyping in the Moodle ecosystem.

## ⚙️ Installation (for demo purposes)

⚠️ **Note**: This is a demonstration plugin created for a presentation and should be thoroughly tested before any production use.

1. Clone or download this repository.
2. Extract the contents into your Moodle installation under the contentbank/contenttype/ directory.
3. Ensure the folder name matches your plugin component name (e.g., `image`).
4. Log in to your Moodle site as an administrator and navigate to Site administration > Notifications to trigger the installation.

## 👥 Acknowledgements

Special thanks to the organisers and community at MoodleMoot Euskadi 2026.
