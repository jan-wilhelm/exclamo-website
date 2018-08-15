<template>
	<form @submit.prevent="onSubmit" class="form-inline message-form" autocomplete="off">
		<input type="text" ref="message" class="form-control col-md-10 col-sm-9 col-12 chat-input" name="message" autocomplete="off">
		<input type="text" class="d-none">
		<button type="submit" class="btn bg-color-primary-3 text-white col-md-2 col-sm-3 col-4 mx-auto chat-send">
			<i class="fas fa-paper-plane"></i>
		</button>
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
		border-bottom-right-radius: 0px;
		border-top-right-radius: 0px;
	}
	.chat-send {
		border-bottom-left-radius: 0px;
		border-top-left-radius: 0px;
	}
</style>