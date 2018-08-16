const baseUrl = window.Exclamo.url

function filterNumericals(fromString) {
	return fromString.replace(/\D/g,'');
}

function getCaseIdFromUrl() {
	var urlSegments = window.location.href.split("/")
	return Number(filterNumericals(urlSegments[urlSegments.length - 1])) 
}

export class ReportedCase {
	constructor(caseId) {
		this.caseId = caseId || getCaseIdFromUrl();
	}

	setAnonymous(anonymous) {
		axios.put(baseUrl + "/api/cases/" + this.caseId, {
			title: "AAAA UPDATED TITLE"
		})
		.then(function (response) {
			console.log(response);
		})
		.catch(function (error) {
    console.log(error.response)
		});
	}
}

export default {
	baseUrl,
	getCaseIdFromUrl,
	ReportedCase
}