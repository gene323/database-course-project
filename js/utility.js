function deleteRecord(url, postName, id) {
	if (confirm("Do you want to delete?")) {
		$.ajax(url, {
			type: 'post',
			data: {
				'ID': id,
				[postName]: true
			},
			error: function () {
				alert("Something is wrong");
			},
			success: function () {
				alert("Delete successfully");
				location.reload();
			}
		});
	}
}

function toggleInsertModal() {
	let a = document.getElementById("insertModal").style.display;
	if (a === "block") {
		document.getElementById("insertModal").style.display = "none";
	} else {
		document.getElementById("insertModal").style.display = "block";
	}
}

function toggleJournalArticle(id, author, title, volume, number, page, date, organization) {
	let a = document.getElementById("editModal");
	if (a.style.display === 'block') {
		a.style.display = 'none';
	} else {
		a.style.display = 'block';
		document.getElementById("editID").value = id;
		document.getElementById("editAuthor").value = author;
		document.getElementById("editTitle").value = title;
		document.getElementById("editVolume").value = volume;
		document.getElementById("editNumber").value = number;
		document.getElementById("editPage").value = page;
		document.getElementById("editDate").value = date;
		document.getElementById("editOrganization").value = organization;
	}
}

function toggleConferenceProceeding(id, author, title, conference, page, date, place) {
	let a = document.getElementById("editModal");
	if (a.style.display === 'block') {
		a.style.display = 'none';
	} else {
		a.style.display = 'block';
		document.getElementById("editID").value = id;
		document.getElementById("editAuthor").value = author;
		document.getElementById("editTitle").value = title;
		document.getElementById("editConference").value = conference;
		document.getElementById("editPage").value = page;
		document.getElementById("editDate").value = date;
		document.getElementById("editPlace").value = place;
	}
}

function toggleLiterature(ISBN, author, title, date, publishingHouse) {
	let a = document.getElementById("editModal");
	if (a.style.display === 'block') {
		a.style.display = 'none';
	} else {
		a.style.display = 'block';
		document.getElementById('editNewISBN').value = ISBN;
		document.getElementById('editOldISBN').value = ISBN;
		document.getElementById('editAuthor').value = author;
		document.getElementById('editTitle').value = title;
		document.getElementById('editDate').value = date;
		document.getElementById('editPublishingHouse').value = publishingHouse;
	}

}

function toggleTopImg() {
	let a = document.getElementById("backToTop");
	console.log(document.documentElement.scrollTop);
	if (document.body.scrollTop > 72 || document.documentElement.scrollTop > 72) {
		a.style.display = "block";
	} else {
		a.style.display = "none";
	}
}

function toggleNSTCProject(id, title, dateBegin, dateEnd, code, position) {
	let a = document.getElementById("editModal");
	if (a.style.display === 'block') {
		a.style.display = 'none';
	} else {
		a.style.display = 'block';
		document.getElementById('editID').value = id;
		document.getElementById('editTitle').value = title;
		document.getElementById('editDateBegin').value = dateBegin;
		document.getElementById('editDateEnd').value = dateEnd;
		document.getElementById('editCode').value = code;
		document.getElementById('editPosition').value = position;
	}
}

function toggleIndustryAcademyCooperationProject(id, title, dateBegin, dateEnd, position) {
	let a = document.getElementById("editModal");
	if (a.style.display === 'block') {
		a.style.display = 'none';
	} else {
		a.style.display = 'block';
		document.getElementById('editID').value = id;
		document.getElementById('editTitle').value = title;
		document.getElementById('editDateBegin').value = dateBegin;
		document.getElementById('editDateEnd').value = dateEnd;
		document.getElementById('editPosition').value = position;
	}
}