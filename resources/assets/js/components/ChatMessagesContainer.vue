<template>
	<div id="chat-container" class="chat-container p-4 d-flex flex-column">
		<chat-message v-for="message in messages" :key="message.id" :body="message.body" :date="message.date" :sent-by-user="message.sentByUser" :user="message.user">
		</chat-message>
	</div>
</template>

<script>
	
	export default {

		props: ["messages"],
		data() {
			return {

			}
		}

	};

</script>

<style scoped>

</style>