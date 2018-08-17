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

	edit(options, successFunction, errorFunction) {
		axios.put(baseUrl + "/api/cases/" + this.caseId, options)
		.then(function (response) {
			console.log(response);
			successFunction(response);
		})
		.catch(function (error) {
    		console.log(error)
    		errorFunction(error);
		});
		return this;
	}

	setAnonymous(anonymous) {
		return this.edit({anonymous: anonymous});
	}

	setSolved(solved) {
		return this.edit({solved: solved});
	}

	setMentors(mentors) {
		return this.edit({mentors: mentors});
	}

}

export default {
	baseUrl,
	getCaseIdFromUrl,
	ReportedCase
}