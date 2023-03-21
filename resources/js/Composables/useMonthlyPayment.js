import { computed, isRef } from 'vue'
export const useMonthlyPayment = (price, duration, interestRate) => {

  const computedPrice = computed(() => isRef(price) ? price.value : price)
  const computedDuration = computed(() => isRef(duration) ? duration.value : duration)
  const computedInterest = computed(() => isRef(interestRate) ? interestRate.value : interestRate)

  const monthlyPayment = computed(() => {
    const months = computedDuration.value * 12
    const monthlyInterestRate = computedInterest.value / 12 / 100
    const numerator = computedPrice.value * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, months)
    const denominator = Math.pow(1 + monthlyInterestRate, months) - 1
    const monthlyPayment = Math.ceil(numerator / denominator)
  
    return monthlyPayment
  })
  
  const totalPaid = computed(() => computedDuration.value * 12 * monthlyPayment.value)

  const totalInterest = computed(() => totalPaid.value - computedPrice.value)

  return { monthlyPayment, totalPaid, totalInterest } 
}