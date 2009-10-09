	function TopNavOver(intIndexId, strToken) {
		for (var intIndex = 2; intIndex <= 8; intIndex++) {
			var objLink = document.getElementById("navhref_" + intIndex);
			objLink.style.display = 'none';
		}

		var objLink = document.getElementById("navhref_" + intIndexId);
		objLink.style.display = 'block';
	}
	
	function TopNavOut(intIndexId) {
		var objLink = document.getElementById("navhref_" + intIndexId);
		objLink.style.display = 'none';
	}
	
	function AdOver(intIndexId) {
		document.getElementById("ad_" + intIndexId).className += " top_ad_highlight";
	}
	
	function AdOut(intIndexId) {
		document.getElementById("ad_" + intIndexId).className = document.getElementById("ad_" + intIndexId).className.replace(/ top_ad_highlight/, "");
	}

	function ForumOver(intForumId) {
		document.getElementById("forum_item_" + intForumId).className = "forum_item forum_item_highlight";
		document.getElementById("forum_description_" + intForumId).className = "forum_item_description forum_item_description_highlight";
		document.getElementById("forum_icon_" + intForumId).className = "forum_item_icon forum_item_icon_highlight";
	}

	function ForumOut(intForumId) {
		document.getElementById("forum_item_" + intForumId).className = "forum_item";
		document.getElementById("forum_description_" + intForumId).className = "forum_item_description";
		document.getElementById("forum_icon_" + intForumId).className = "forum_item_icon";
	}
	function TopicOver(intForumId) {
		document.getElementById("topic_item_" + intForumId).className = "topic_item topic_item_highlight";
	}

	function TopicOut(intForumId) {
		if (intForumId % 2)
			document.getElementById("topic_item_" + intForumId).className = "topic_item topic_item_alternate";
		else
			document.getElementById("topic_item_" + intForumId).className = "topic_item";
	}
	
	function hideNewMessage() {
		document.getElementById("newMessage").style.display = 'none';
	}
	
	function DownloadFileOver(intForumId) {
		document.getElementById("download_file_" + intForumId).className += " download_files_highlight";
	}

	function DownloadFileOut(intForumId) {
		document.getElementById("download_file_" + intForumId).className = document.getElementById("download_file_" + intForumId).className.replace(/ download_files_highlight/, "");
	}
