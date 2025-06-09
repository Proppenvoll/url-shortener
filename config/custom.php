<?php

return [
    'git_repo_url' => env("GIT_REPO_URL") ?? throw new Exception("Missing GIT_REPO_URL env variable"),
];
