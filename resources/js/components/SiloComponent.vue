<template>
              <div class="">
                  <div id="silo" class="silo-progressbar"></div>
              </div>
</template>

<script>

export default {
mounted() {
    
},
}
</script>

<style>
.silo-progressbar{
	padding: 10px;
}
.silo-progressbar .progress-container{
	margin: 0 auto;
	position: relative;
}
.silo-progressbar .progress-container *{
	position: absolute;
}
.silo-progressbar .progress-container .progress{
	background-color: #34cb00;
	width: 100%;
}
.silo-progressbar .progress-container .image{
	background-repeat: no-repeat;
	background-origin: border-box;
	background-position: center;
	background-size: cover;
	background-color: transparent;
	height: 100%;
	width: 100%;
}
.silo-progressbar .progress-container label{
	cursor: pointer;
	font-weight: bold;
	text-align: center;
	top: 35%;
	width: 100%;
}
</style>