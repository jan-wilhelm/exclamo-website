<template>
	<div>
		<div ref="container" id="chat-container" class="chat-container px-4 d-flex flex-column">
			<chat-message v-for="message in messageObjects" :key="message.id" :messageObject="message">
			</chat-message>
		</div>
		<chat-input-form ref="input" @sendMessage="sendMessage"></chat-input-form>
	</div>
</template>

<script>
	import ExclamoApi from '../api';

	export default {
		props: ["messages"],
		data() {
			return {
				messageObjects: this.messages
			}
		},
		methods: {
			sendMessage(message) {
				var text = message.text.trim()

				// Assert that the message is not empty
				if (!text) {
					return;
				}

				var formattedDate = this.getFormattedDate()
				var messageObject = {
					body: text,
					sentByUser: true,
					date: formattedDate,
					sending: true
				}

				this.messageObjects.push(messageObject);
				this.sendMessageToServer(messageObject);
				this.clearField()
				Vue.nextTick(this.scrollToBottom)
			},
			scrollToBottom() {
				var cont = this.$refs.container
				cont.scrollTop = cont.scrollHeight
			},
			clearField() {
				this.$refs.input.clear()
			},
			getFormattedDate() {
				var today = new Date(Date.now())
				var day = today.getDate()
				var month = today.getMonth() + 1 //January is 0!
				var hours = today.getHours()
				var mins = today.getMinutes()
				var year = today.getFullYear()

				if (day < 10){
				    day = '0' + day
				}
				if (month < 10){
				    month = '0' + month
				}
				if (hours < 10){
				    hours = '0' + hours
				} 
				if (mins < 10){
				    mins = '0' + mins
				}

				return day + '.' + month + '.' + year + ' ' + hours + ':' + mins
			},
			sendMessageToServer(messageObject) {
				var urlSegments = window.location.href.split("/")
				var caseId = ExclamoApi.getCaseIdFromUrl()

				ExclamoApi.Message.create(messageObject.body, caseId)
					.then(function(response) {
						console.log(response)
						messageObject.sending = false
					}).catch(function(error) {
						console.log(error);
	    				console.log(error.response)
					})
			},
			filterNumericals(fromString) {
				return fromString.replace(/\D/g,'');
			}
		},
		mounted() {
			this.scrollToBottom()

			let caseId = ExclamoApi.getCaseIdFromUrl()

			window.Echo.private('cases.' + caseId).listen('MessageSent', (e) => {
				console.log(e);
				this.messageObjects.push(e);
		    	Vue.nextTick(this.scrollToBottom)
		    });
		}
	};

</script>

<style>

	@media (min-width: 768px) {
		.chat-container {
			overflow: auto;
			max-height: calc(100vh - 345px);
			min-height: 500px !important;
			padding-bottom: 10px;
		}
	}

	.chat-container::after {
	    display: block;
	    height: 50px;
	    width: 100%;
	}
</style>