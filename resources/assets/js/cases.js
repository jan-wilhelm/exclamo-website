import ExclamoAPI from './api';

let caseId = ExclamoAPI.getCaseIdFromUrl()

window.Echo.private('cases.' + caseId)
    .listen('MessageSent', (e) => {
        console.log(e);
    });