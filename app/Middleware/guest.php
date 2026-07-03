<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
// Guest pages should stay accessible even if a session already exists.
