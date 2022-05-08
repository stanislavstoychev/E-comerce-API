<template></template>

<script>
export default {
  created() {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    Toast.fire({
      icon: "success",
      title: "LogOut Successfully",
    });
    this.$router.push({ name: "/" });
  },
};
</script>

<style>
</style>
