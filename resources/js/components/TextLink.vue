<script setup lang="ts">
import { Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';

interface Props {
  href: string;
  tabindex?: number;
  method?: Method;
  as?: string;
  class?: string | string[] | Record<string, boolean>; // ✅ Accept class prop
}

const props = defineProps<Props>();
</script>

<template>
  <Link
    :href="href"
    :tabindex="tabindex"
    :method="method"
    :as="as"
    :class="[
      'underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500',
      props.class
    ]"
  >
    <slot />
  </Link>
</template>
