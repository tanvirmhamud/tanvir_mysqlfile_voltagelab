add_filter('onesignal_send_notification','onesignal_send_notification_filter',10,4);
function onesignal_send_notification_filter($fields,$new_status,$old_status,$post){
	$fields['isAndroid'] = true;
	$fields['isIos'] = true;
	$fields['web_url'] = $fields['url'];
	unset($fields['url']);
	$fields['data'] = array("post_id" => $post->ID);
	return $fields;
}