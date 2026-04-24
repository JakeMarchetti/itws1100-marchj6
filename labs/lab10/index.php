<?php
// header() must run before any output because PHP needs to send HTTP headers
// before the response body; once output starts, the redirect header can't be changed.
header("Location: /iit/", true, 302);
exit;
