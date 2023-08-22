
# Checkout Options

## Structure

`CheckoutOptions`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `allowTipping` | `?bool` | Optional | Indicates whether the payment allows tipping. | getAllowTipping(): ?bool | setAllowTipping(?bool allowTipping): void |
| `customFields` | [`?(CustomField[])`](../../doc/models/custom-field.md) | Optional | The custom fields requesting information from the buyer. | getCustomFields(): ?array | setCustomFields(?array customFields): void |
| `subscriptionPlanId` | `?string` | Optional | The ID of the subscription plan for the buyer to pay and subscribe.<br>For more information, see [Subscription Plan Checkout](https://developer.squareup.com/docs/checkout-api/subscription-plan-checkout).<br>**Constraints**: *Maximum Length*: `255` | getSubscriptionPlanId(): ?string | setSubscriptionPlanId(?string subscriptionPlanId): void |
| `redirectUrl` | `?string` | Optional | The confirmation page URL to redirect the buyer to after Square processes the payment.<br>**Constraints**: *Maximum Length*: `2048` | getRedirectUrl(): ?string | setRedirectUrl(?string redirectUrl): void |
| `merchantSupportEmail` | `?string` | Optional | The email address that buyers can use to contact the seller.<br>**Constraints**: *Maximum Length*: `256` | getMerchantSupportEmail(): ?string | setMerchantSupportEmail(?string merchantSupportEmail): void |
| `askForShippingAddress` | `?bool` | Optional | Indicates whether to include the address fields in the payment form. | getAskForShippingAddress(): ?bool | setAskForShippingAddress(?bool askForShippingAddress): void |
| `acceptedPaymentMethods` | [`?AcceptedPaymentMethods`](../../doc/models/accepted-payment-methods.md) | Optional | - | getAcceptedPaymentMethods(): ?AcceptedPaymentMethods | setAcceptedPaymentMethods(?AcceptedPaymentMethods acceptedPaymentMethods): void |

## Example (as JSON)

```json
{
  "allow_tipping": null,
  "custom_fields": null,
  "subscription_plan_id": null,
  "redirect_url": null,
  "merchant_support_email": null,
  "ask_for_shipping_address": null,
  "accepted_payment_methods": null
}
```

