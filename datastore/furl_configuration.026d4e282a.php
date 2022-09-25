<?php

return <<<'VALUE'
"{\"forums_rss\":{\"friendly\":\"forum\\\/{#id}-{?}.xml\",\"real\":\"app=forums&module=forums&controller=forums&rss=1\",\"with_top_level\":\"forums\\\/forum\\\/{#id}-{?}.xml\",\"regex\":[\"forum\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\.xml\",\"forums\\\\\\\/forum\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\.xml\"],\"params\":[\"id\",\"\"]},\"forums_forum\":{\"friendly\":\"forum\\\/{#id}-{?}\",\"real\":\"app=forums&module=forums&controller=forums\",\"verify\":\"\\\\IPS\\\\forums\\\\Forum\",\"seoPagination\":true,\"with_top_level\":\"forums\\\/forum\\\/{#id}-{?}\",\"regex\":[\"forum\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"forums\\\\\\\/forum\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"forums_clubs\":{\"friendly\":\"forum\\\/clubs\",\"real\":\"app=forums&module=forums&controller=forums&do=clubs\",\"with_top_level\":\"forums\\\/forum\\\/clubs\",\"regex\":[\"forum\\\\\\\/clubs\",\"forums\\\\\\\/forum\\\\\\\/clubs\"],\"params\":[]},\"topic_copy\":{\"friendly\":\"topic\\\/{#id}-{?}\\\/copy\",\"real\":\"app=cms&module=database&controller=topic\",\"with_top_level\":\"forums\\\/topic\\\/{#id}-{?}\\\/copy\",\"regex\":[\"topic\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/copy\",\"forums\\\\\\\/topic\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/copy\"],\"params\":[\"id\",\"\"]},\"forums_topic\":{\"friendly\":\"topic\\\/{#id}-{?}\",\"real\":\"app=forums&module=forums&controller=topic\",\"verify\":\"\\\\IPS\\\\forums\\\\Topic\",\"seoPagination\":true,\"with_top_level\":\"forums\\\/topic\\\/{#id}-{?}\",\"regex\":[\"topic\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"forums\\\\\\\/topic\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"forums\":{\"friendly\":\"\",\"real\":\"app=forums&module=forums&controller=index\",\"with_top_level\":\"forums\",\"regex\":[\"\",\"forums\"],\"params\":[]},\"topic_create\":{\"friendly\":\"submit\",\"real\":\"app=forums&module=forums&controller=forums&do=createMenu\",\"with_top_level\":\"forums\\\/submit\",\"regex\":[\"submit\",\"forums\\\\\\\/submit\"],\"params\":[]},\"topic_non_forum_add_button\":{\"friendly\":\"startTopic\",\"real\":\"app=forums&module=forums&controller=forums&do=add\",\"with_top_level\":\"forums\\\/startTopic\",\"regex\":[\"startTopic\",\"forums\\\\\\\/startTopic\"],\"params\":[]},\"login\":{\"friendly\":\"login\",\"real\":\"app=core&module=system&controller=login\",\"regex\":[\"login\"],\"params\":[]},\"logout\":{\"friendly\":\"logout\",\"real\":\"app=core&module=system&controller=login&do=logout\",\"regex\":[\"logout\"],\"params\":[]},\"lostpassword\":{\"friendly\":\"lostpassword\",\"real\":\"app=core&module=system&controller=lostpass\",\"regex\":[\"lostpassword\"],\"params\":[]},\"settings_email\":{\"friendly\":\"settings\\\/email\",\"real\":\"app=core&module=system&controller=settings&area=email\",\"regex\":[\"settings\\\\\\\/email\"],\"params\":[]},\"settings_password\":{\"friendly\":\"settings\\\/password\",\"real\":\"app=core&module=system&controller=settings&area=password\",\"regex\":[\"settings\\\\\\\/password\"],\"params\":[]},\"settings_devices\":{\"friendly\":\"settings\\\/devices\",\"real\":\"app=core&module=system&controller=settings&area=devices\",\"regex\":[\"settings\\\\\\\/devices\"],\"params\":[]},\"settings_secure\":{\"friendly\":\"settings\\\/secure-account\",\"real\":\"app=core&module=system&controller=settings&do=secureAccount\",\"regex\":[\"settings\\\\\\\/secure\\\\-account\"],\"params\":[]},\"settings_mfa\":{\"friendly\":\"settings\\\/account-security\",\"real\":\"app=core&module=system&controller=settings&area=mfa\",\"regex\":[\"settings\\\\\\\/account\\\\-security\"],\"params\":[]},\"mfarecovery\":{\"friendly\":\"account-recovery\",\"real\":\"app=core&module=system&controller=settings&do=mfarecovery\",\"regex\":[\"account\\\\-recovery\"],\"params\":[]},\"mfarecoveryvalidate\":{\"friendly\":\"account-recovery\\\/validate\",\"real\":\"app=core&module=system&controller=settings&do=mfarecoveryvalidate\",\"regex\":[\"account\\\\-recovery\\\\\\\/validate\"],\"params\":[]},\"settings_username\":{\"friendly\":\"settings\\\/username\",\"real\":\"app=core&module=system&controller=settings&area=username\",\"regex\":[\"settings\\\\\\\/username\"],\"params\":[]},\"settings_signature\":{\"friendly\":\"settings\\\/signature\",\"real\":\"app=core&module=system&controller=settings&area=signature\",\"regex\":[\"settings\\\\\\\/signature\"],\"params\":[]},\"settings_login\":{\"friendly\":\"settings\\\/login\",\"real\":\"app=core&module=system&controller=settings&area=login\",\"regex\":[\"settings\\\\\\\/login\"],\"params\":[]},\"settings_apps\":{\"friendly\":\"settings\\\/apps\",\"real\":\"app=core&module=system&controller=settings&area=apps\",\"regex\":[\"settings\\\\\\\/apps\"],\"params\":[]},\"settings\":{\"friendly\":\"settings\",\"real\":\"app=core&module=system&controller=settings\",\"regex\":[\"settings\"],\"params\":[]},\"unsubscribe\":{\"friendly\":\"unsubscribe\",\"real\":\"app=core&module=system&controller=unsubscribe\",\"regex\":[\"unsubscribe\"],\"params\":[]},\"privacy\":{\"friendly\":\"privacy\",\"real\":\"app=core&module=system&controller=privacy\",\"regex\":[\"privacy\",\"privacypolicy\"],\"params\":[]},\"register\":{\"friendly\":\"register\",\"real\":\"app=core&module=system&controller=register\",\"regex\":[\"register\"],\"params\":[]},\"attachments\":{\"friendly\":\"attachments\",\"real\":\"app=core&module=system&controller=attachments\",\"regex\":[\"attachments\"],\"params\":[]},\"cookies\":{\"friendly\":\"cookies\",\"real\":\"app=core&module=system&controller=cookies\",\"regex\":[\"cookies\",\"cookies\"],\"params\":[]},\"messenger_compose\":{\"friendly\":\"messenger\\\/compose\",\"real\":\"app=core&module=messaging&controller=messenger&do=compose\",\"regex\":[\"messenger\\\\\\\/compose\"],\"params\":[]},\"messenger_convo\":{\"friendly\":\"messenger\\\/{#id}\",\"real\":\"app=core&module=messaging&controller=messenger\",\"regex\":[\"messenger\\\\\\\/(\\\\d+?)\"],\"params\":[\"id\"]},\"messenger_unread\":{\"friendly\":\"messenger\\\/unread\",\"real\":\"app=core&module=messaging&controller=messenger&folder=unread\",\"regex\":[\"messenger\\\\\\\/unread\"],\"params\":[]},\"messenger_drafts\":{\"friendly\":\"messenger\\\/drafts\",\"real\":\"app=core&module=messaging&controller=messenger&folder=drafts\",\"regex\":[\"messenger\\\\\\\/drafts\"],\"params\":[]},\"messaging\":{\"friendly\":\"messenger\",\"real\":\"app=core&module=messaging&controller=messenger\",\"regex\":[\"messenger\"],\"params\":[]},\"warn_add\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/warnings\\\/add\",\"real\":\"app=core&module=system&controller=warnings&do=warn\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/warnings\\\\\\\/add\"],\"params\":[\"id\",\"\"]},\"warn_view\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/warnings\\\/{#w}\",\"real\":\"app=core&module=system&controller=warnings&do=view\",\"verify\":\"\\\\IPS\\\\core\\\\Warnings\\\\Warning\",\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/warnings\\\\\\\/(\\\\d+?)\"],\"params\":[\"id\",\"\",\"w\"]},\"warn_list\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/warnings\",\"real\":\"app=core&module=system&controller=warnings\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/warnings\"],\"params\":[\"id\",\"\"]},\"profile_content\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/content\",\"real\":\"app=core&module=members&controller=profile&do=content\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"seoPagination\":true,\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/content\"],\"params\":[\"id\",\"\"]},\"profile_reputation\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/reputation\",\"real\":\"app=core&module=members&controller=profile&do=reputation\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/reputation\"],\"params\":[\"id\",\"\"]},\"edit_profile\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/edit\",\"real\":\"app=core&module=members&controller=profile&do=edit\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/edit\"],\"params\":[\"id\",\"\"]},\"edit_profile_photo\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/photo\",\"real\":\"app=core&module=members&controller=profile&do=editPhoto\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/photo\"],\"params\":[\"id\",\"\"]},\"flag_as_spammer\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/spammer\",\"real\":\"app=core&module=system&controller=moderation&do=flagAsSpammer\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/spammer\"],\"params\":[\"id\",\"\"]},\"profile_followers\":{\"friendly\":\"profile\\\/{#id}-{?}\\\/followers\",\"real\":\"app=core&module=members&controller=profile&do=followers\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\\\\/followers\"],\"params\":[\"id\",\"\"]},\"profile\":{\"friendly\":\"profile\\\/{#id}-{?}\",\"real\":\"app=core&module=members&controller=profile\",\"verify\":\"\\\\IPS\\\\Member\",\"regex\":[\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"user\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"modcp_announcements\":{\"friendly\":\"modcp\\\/announcements\",\"real\":\"app=core&module=modcp&controller=modcp&tab=announcements\",\"regex\":[\"modcp\\\\\\\/announcements\"],\"params\":[]},\"modcp_report\":{\"friendly\":\"modcp\\\/reports\\\/{#id}\",\"real\":\"app=core&module=modcp&controller=modcp&tab=reports&action=view\",\"regex\":[\"modcp\\\\\\\/reports\\\\\\\/(\\\\d+?)\"],\"params\":[\"id\"]},\"modcp\":{\"friendly\":\"modcp\",\"real\":\"app=core&module=modcp&controller=modcp\",\"regex\":[\"modcp\"],\"params\":[]},\"modcp_members\":{\"friendly\":\"modcp\\\/members\",\"real\":\"app=core&module=modcp&controller=modcp&tab=members\",\"regex\":[\"modcp\\\\\\\/members\"],\"params\":[]},\"modcp_reports\":{\"friendly\":\"modcp\\\/reports\",\"real\":\"app=core&module=modcp&controller=modcp&tab=reports\",\"regex\":[\"modcp\\\\\\\/reports\"],\"params\":[]},\"modcp_content\":{\"friendly\":\"modcp\\\/content\",\"real\":\"app=core&module=modcp&controller=modcp&tab=hidden\",\"regex\":[\"modcp\\\\\\\/content\"],\"params\":[]},\"modcp_approval\":{\"friendly\":\"modcp\\\/approval-queue\",\"real\":\"app=core&module=modcp&controller=modcp&tab=approval\",\"regex\":[\"modcp\\\\\\\/approval\\\\-queue\"],\"params\":[]},\"modcp_recent_warnings\":{\"friendly\":\"modcp\\\/recent-warnings\",\"real\":\"app=core&module=modcp&controller=modcp&tab=recent_warnings\",\"regex\":[\"modcp\\\\\\\/recent\\\\-warnings\"],\"params\":[]},\"modcp_ip_tools\":{\"friendly\":\"modcp\\\/ip-tools\",\"real\":\"app=core&module=modcp&controller=modcp&tab=ip_tools\",\"regex\":[\"modcp\\\\\\\/ip\\\\-tools\"],\"params\":[]},\"modcp_deleted\":{\"friendly\":\"modcp\\\/deleted\",\"real\":\"app=core&module=modcp&controller=modcp&tab=deleted\",\"regex\":[\"modcp\\\\\\\/deleted\"],\"params\":[]},\"ignore\":{\"friendly\":\"ignore\",\"real\":\"app=core&module=system&controller=ignore\",\"regex\":[\"ignore\"],\"params\":[]},\"online\":{\"friendly\":\"online\",\"real\":\"app=core&module=online&controller=online\",\"regex\":[\"online\"],\"params\":[]},\"staffdirectory\":{\"friendly\":\"staff\",\"real\":\"app=core&module=staffdirectory&controller=directory\",\"regex\":[\"staff\"],\"params\":[]},\"guidelines\":{\"friendly\":\"guidelines\",\"real\":\"app=core&module=system&controller=guidelines\",\"regex\":[\"guidelines\"],\"params\":[]},\"notifications_options\":{\"friendly\":\"notifications\\\/options\",\"real\":\"app=core&module=system&controller=notifications&do=options\",\"regex\":[\"notifications\\\\\\\/options\"],\"params\":[]},\"notifications\":{\"friendly\":\"notifications\",\"real\":\"app=core&module=system&controller=notifications\",\"regex\":[\"notifications\"],\"params\":[]},\"terms\":{\"friendly\":\"terms\",\"real\":\"app=core&module=system&controller=terms\",\"regex\":[\"terms\"],\"params\":[]},\"announcement\":{\"friendly\":\"announcement\\\/{#id}-{?}\",\"real\":\"app=core&module=system&controller=announcement\",\"regex\":[\"announcement\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"contact\":{\"friendly\":\"contact\",\"real\":\"app=core&module=contact&controller=contact\",\"regex\":[\"contact\"],\"params\":[]},\"followed_content\":{\"friendly\":\"followed\",\"real\":\"app=core&module=system&controller=followed\",\"regex\":[\"followed\"],\"params\":[]},\"search\":{\"friendly\":\"search\",\"real\":\"app=core&module=search&controller=search\",\"regex\":[\"search\"],\"params\":[]},\"discover_unread\":{\"friendly\":\"discover\\\/unread\",\"real\":\"app=core&module=discover&controller=streams&id=1\",\"regex\":[\"discover\\\\\\\/unread\"],\"params\":[]},\"discover_istarted\":{\"friendly\":\"discover\\\/content-started\",\"real\":\"app=core&module=discover&controller=streams&id=2\",\"regex\":[\"discover\\\\\\\/content\\\\-started\"],\"params\":[]},\"discover_followed\":{\"friendly\":\"discover\\\/followed-content\",\"real\":\"app=core&module=discover&controller=streams&id=3\",\"regex\":[\"discover\\\\\\\/followed\\\\-content\"],\"params\":[]},\"discover_following\":{\"friendly\":\"discover\\\/followed-members\",\"real\":\"app=core&module=discover&controller=streams&id=4\",\"regex\":[\"discover\\\\\\\/followed\\\\-members\"],\"params\":[]},\"discover_posted\":{\"friendly\":\"discover\\\/content-posted\",\"real\":\"app=core&module=discover&controller=streams&id=5\",\"regex\":[\"discover\\\\\\\/content\\\\-posted\"],\"params\":[]},\"discover_stream\":{\"friendly\":\"discover\\\/{#id}\",\"real\":\"app=core&module=discover&controller=streams\",\"regex\":[\"discover\\\\\\\/(\\\\d+?)\"],\"params\":[\"id\"]},\"discover_rss_all_activity\":{\"friendly\":\"discover\\\/all.xml\",\"real\":\"app=core&module=discover&controller=streams&rss=1\",\"regex\":[\"discover\\\\\\\/all\\\\.xml\"],\"params\":[]},\"discover_rss\":{\"friendly\":\"discover\\\/{#id}.xml\",\"real\":\"app=core&module=discover&controller=streams&rss=1\",\"regex\":[\"discover\\\\\\\/(\\\\d+?)\\\\.xml\"],\"params\":[\"id\"]},\"discover_all\":{\"friendly\":\"discover\",\"real\":\"app=core&module=discover&controller=streams\",\"regex\":[\"discover\"],\"params\":[]},\"rss_feed\":{\"friendly\":\"rss\\\/{#id}-{?}.xml\",\"real\":\"app=core&module=discover&controller=rss\",\"verify\":\"\\\\IPS\\\\core\\\\Rss\",\"regex\":[\"rss\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\\\\.xml\"],\"params\":[\"id\",\"\"]},\"language\":{\"friendly\":\"language\",\"real\":\"app=core&module=system&controller=language\",\"regex\":[\"language\"],\"params\":[]},\"theme\":{\"friendly\":\"theme\",\"real\":\"app=core&module=system&controller=theme\",\"regex\":[\"theme\"],\"params\":[]},\"mark_site_as_read\":{\"friendly\":\"markallread\",\"real\":\"app=core&module=system&controller=markread\",\"regex\":[\"markallread\"],\"params\":[]},\"tags\":{\"friendly\":\"tags\\\/{@tags}\",\"real\":\"app=core&module=search&controller=search\",\"regex\":[\"tags\\\\\\\/(.+?)\"],\"params\":[\"tags\"]},\"activity\":{\"friendly\":\"activity\",\"real\":\"app=core&module=activity&controller=activity\",\"regex\":[\"activity\"],\"params\":[]},\"vnc\":{\"friendly\":\"new-content\",\"real\":\"app=core&module=discover&controller=vnc\",\"regex\":[\"new\\\\-content\"],\"params\":[]},\"leaderboard_leaderboard\":{\"friendly\":\"leaderboard\",\"real\":\"app=core&module=discover&controller=popular&tab=leaderboard\",\"regex\":[\"leaderboard\"],\"params\":[]},\"leaderboard_history\":{\"friendly\":\"pastleaders\",\"real\":\"app=core&module=discover&controller=popular&tab=history\",\"regex\":[\"pastleaders\"],\"params\":[]},\"leaderboard_members\":{\"friendly\":\"topmembers\",\"real\":\"app=core&module=discover&controller=popular&tab=members\",\"regex\":[\"topmembers\"],\"params\":[]},\"clubs_list\":{\"friendly\":\"clubs\",\"real\":\"app=core&module=clubs&controller=directory\",\"regex\":[\"clubs\"],\"params\":[]},\"clubs_view\":{\"friendly\":\"clubs\\\/{#id}-{?}\",\"real\":\"app=core&module=clubs&controller=view\",\"verify\":\"\\\\IPS\\\\Member\\\\Club\",\"regex\":[\"clubs\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"promote_history\":{\"friendly\":\"promote\\\/history-{#promote_id}\",\"real\":\"app=core&module=promote&controller=promote&do=history\",\"regex\":[\"promote\\\\\\\/history\\\\-(\\\\d+?)\"],\"params\":[\"promote_id\"]},\"promote_manage\":{\"friendly\":\"promote\\\/manage\",\"real\":\"app=core&module=promote&controller=promote&do=view\",\"regex\":[\"promote\\\\\\\/manage\"],\"params\":[]},\"promote_show\":{\"friendly\":\"ourpicks\",\"real\":\"app=core&module=promote&controller=ourpicks\",\"regex\":[\"ourpicks\"],\"params\":[]},\"promote\":{\"friendly\":\"promote\",\"real\":\"app=core&module=promote&controller=promote\",\"regex\":[\"promote\"],\"params\":[]},\"manifest\":{\"friendly\":\"manifest.webmanifest\",\"real\":\"app=core&module=system&controller=metatags&do=manifest\",\"regex\":[\"manifest\\\\.webmanifest\"],\"params\":[]},\"iebrowserconfig\":{\"friendly\":\"browserconfig.xml\",\"real\":\"app=core&module=system&controller=metatags&do=iebrowserconfig\",\"regex\":[\"browserconfig\\\\.xml\"],\"params\":[]},\"chatbox\":{\"friendly\":\"bimchatbox\",\"real\":\"app=bimchatbox&module=chatbox&controller=chatbox\",\"without_top_level\":\"\",\"regex\":[\"bimchatbox\"],\"params\":[]},\"invite_accept\":{\"friendly\":\"discord\\\/invite\\\/{@icode}\\\/accept\",\"real\":\"app=brilliantdiscord&module=xinvites&controller=invite&do=accept\",\"without_top_level\":\"invite\\\/{@icode}\\\/accept\",\"regex\":[\"discord\\\\\\\/invite\\\\\\\/(.+?)\\\\\\\/accept\",\"invite\\\\\\\/(.+?)\\\\\\\/accept\"],\"params\":[\"icode\"]},\"invite\":{\"friendly\":\"discord\\\/invite\\\/{@icode}\",\"real\":\"app=brilliantdiscord&module=xinvites&controller=invite\",\"without_top_level\":\"invite\\\/{@icode}\",\"regex\":[\"discord\\\\\\\/invite\\\\\\\/(.+?)\",\"invite\\\\\\\/(.+?)\"],\"params\":[\"icode\"]},\"awards\":{\"friendly\":\"awards\",\"real\":\"app=awards&module=awards&controller=index\",\"without_top_level\":\"\",\"regex\":[\"awards\"],\"params\":[]},\"awards_cat\":{\"friendly\":\"awards\\\/category\\\/{#id}-{?}\",\"real\":\"app=awards&module=awards&controller=awards\",\"verify\":\"\\\\IPS\\\\awards\\\\Cats\",\"without_top_level\":\"category\\\/{#id}-{?}\",\"regex\":[\"awards\\\\\\\/category\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"category\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"view_awards\":{\"friendly\":\"awards\\\/awards\\\/{#id}-{?}\",\"real\":\"app=awards&module=awards&controller=awards\",\"verify\":\"\\\\IPS\\\\awards\\\\Cats\",\"without_top_level\":\"awards\\\/{#id}-{?}\",\"regex\":[\"awards\\\\\\\/awards\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"awards\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]},\"settings_awards\":{\"friendly\":\"awards\\\/settings\\\/awards\",\"real\":\"app=core&module=system&controller=settings&area=awards\",\"without_top_level\":\"settings\\\/awards\",\"regex\":[\"awards\\\\\\\/settings\\\\\\\/awards\",\"settings\\\\\\\/awards\"],\"params\":[]},\"awards_new\":{\"friendly\":\"awards\\\/award\\\/new\",\"real\":\"app=awards&module=awards&controller=ajaxcreate&do=newAward\",\"without_top_level\":\"award\\\/new\",\"regex\":[\"awards\\\\\\\/award\\\\\\\/new\",\"award\\\\\\\/new\"],\"params\":[]},\"profile_awards\":{\"friendly\":\"awards\\\/profile\\\/{#id}-{?}\",\"real\":\"app=core&module=members&controller=profile&do=awards\",\"seoTitles\":[{\"class\":\"\\\\IPS\\\\Member\",\"queryParam\":\"id\",\"property\":\"members_seo_name\"}],\"without_top_level\":\"profile\\\/{#id}-{?}\",\"regex\":[\"awards\\\\\\\/profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\",\"profile\\\\\\\/(\\\\d+?)\\\\-(?![&\\\\\\\/])(.+?)\"],\"params\":[\"id\",\"\"]}}"
VALUE;
