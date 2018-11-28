<template>
	<form @submit.prevent="onSubmit" class="form-inline message-form" autocomplete="off">
		<input type="text" ref="message" class="form-control col chat-input" name="message" autocomplete="off" />
		<input type="text" class="d-none">
		<div class="col-auto chat-send">
			<button type="submit" class="chat-send-button cta cta-primary text-white m-0 p-0">
				<i class="fas fa-paper-plane"></i>
			</button>
		</div>
	</form>
</template>

<script>
	export default {
		data() {
			return {

			}
		},
		methods: {
			onSubmit() {
				this.$emit("sendMessage", {
					text: this.$refs.message.value
				});
			},
			clear() {
				this.$refs.message.value = ""
			}
		}
	};
</script>

<style>
	.chat-input {
		border-radius: calc(1.125rem + 1px);
	}
	.chat-send {
		display: inline-block;
		font-size: 20px;
		text-align: right;
	}
	.chat-send-button {
		margin-left: auto;

		text-align: center;
		width: 50px;
		height: 50px;
		border-radius: 25px;
	}
</style>