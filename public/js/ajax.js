function ajax(url, callback) {
	const req = new XMLHttpRequest();
	req.onreadystatechange = function() {
		if (this.readyState == 4) {
			if (this.status == 200) {
				callback(this.responseText);
			} else {
				console.error("XHR error!");
			}
		}
	}
	req.open("GET", url);
	req.send();
}