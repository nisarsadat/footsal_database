<template>
  <div class="animation-container">
    <!-- Football -->
    <div ref="football" class="football">
      ⚽
      <div class="shadow"></div>
    </div>
  </div>
</template>

<script>
import { gsap } from 'gsap';

export default {
  name: 'FootballAnimation',
  mounted() {
    this.animateFootball();
  },
  methods: {
    animateFootball() {
      gsap.to(this.$refs.football, {
        duration: 1,
        x: 100,
        y: 10,
        ease: 'power1.inOut',
        repeat: -1,
        yoyo: true,
      });
    },
  },
};
</script>

<style scoped>
.animation-container {
  position: relative;
  width: 500px;
  height: 150px;
  overflow: hidden;
}

.football {
  position: absolute;
  left: 0;
  bottom: 20px;
  font-size: 50px; /* Size of the football emoji */
  display: flex;
  align-items: center;
  justify-content: center;
}

.shadow {
  position: absolute;
  bottom: -5px;
  left: 15px;
  width: 50px;
  height: 10px;
  background-color: rgba(0, 0, 0, 0.01);
  border-radius: 50%;
  filter: blur(3px);
  transform: scaleX(1);
}

.football::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 15px;
  background-color: rgba(0, 0, 0, 0.05);
  border-radius: 0;
  transform: scale(0.7);
  z-index: -2;
}
</style>
