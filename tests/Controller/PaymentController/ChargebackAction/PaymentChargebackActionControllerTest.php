<?php

namespace Speicher210\FastbillBundle\Test\Controller\PaymentController\ChargebackAction;

use Speicher210\Fastbill\Api\Model\Notification\Customer\Customer;
use Speicher210\Fastbill\Api\Model\Notification\Payment\Payment;
use Speicher210\Fastbill\Api\Model\Notification\Payment\PaymentChargebackNotification;
use Speicher210\Fastbill\Api\Model\Notification\Payment\PaymentSubscription;
use Speicher210\FastbillBundle\Event\PaymentChargebackEvent;
use Speicher210\FastbillBundle\FastbillNotificationEvents;
use Speicher210\FastbillBundle\Test\Controller\AbstractControllerTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test case for payment chargeback notification.
 */
class PaymentChargebackActionControllerTest extends AbstractControllerTestCase
{
    /**
     * @group ttt
     */
    public function testChargebackActionReturns204AndRaisesEventIfRequestIsValid()
    {
        $client = parent::createClient();

        $mock = $this->getMock('stdClass', array('eventHandlerCallback'));
        $mock->expects($this->once())->method('eventHandlerCallback')->with(
            $this->callback(function (PaymentChargebackEvent $event) {
                $payloadData = $event->getPayloadData();
                $this->assertNotNull($payloadData);

                $expectedPayloadData = new PaymentChargebackNotification();
                $expectedPayloadData
                    ->setId(398160)
                    ->setType('payment.chargeback')
                    ->setCreated(new \DateTime('2014-03-13T10:37:08+0000'))
                    ->setCustomer(
                        (new Customer())
                            ->setCustomerId(578266)
                            ->setHash('hash123')
                            ->setCustomerNumber(77)
                            ->setCompanyName('Muster GmbH')
                            ->setTitle('Dr.')
                            ->setSalutation('Herr')
                            ->setFirstName('Martin')
                            ->setLastName('Muster')
                            ->setAddress('Am Musterhuegel 12')
                            ->setAddress2('Postfach 4')
                            ->setZipCode('01234')
                            ->setCity('Musterhausen')
                            ->setCountryCode('DE')
                            ->setEmail('m.muster@email.de')
                            ->setPaymentDataUrl('https://automatic.fastbill.com/accountdata/a1/payment_data_url')
                            ->setDashboardUrl('https://automatic.fastbill.com/dashboard/a1/dashboard_url')
                    )
                    ->setSubscription(
                        (new PaymentSubscription())
                            ->setSubscriptionId(216084)
                            ->setHash('hash123')
                            ->setArticleCode(72)
                            ->setQuantity(1)
                    )
                    ->setPayment(
                        (new Payment())
                            ->setPaymentId(180828)
                            ->setInvoiceId('447236')
                            ->setInvoiceNumber('8')
                            ->setInvoiceUrl('https://automatic.fastbill.com/download/invoice_url')
                            ->setTotalAmount('4.7005')
                            ->setCurrency('EUR')
                            ->setMethod('creditcard')
                            ->setGateway('Adyen')
                            ->setTest('1')
                            ->setType('charge')
                            ->setStatus('open')
                            ->setNextEvent(new \DateTime('2014-03-27T00:00:00+0000'))
                            ->setCreated(new \DateTime('2014-03-06T00:00:00+0000'))
                    );

                $this->assertEquals($expectedPayloadData, $payloadData);

                return true;
            })
        );
        $client
            ->getContainer()
            ->get('event_dispatcher')
            ->addListener(FastbillNotificationEvents::INCOMING_PAYMENT_CHARGEBACK, array($mock, 'eventHandlerCallback'));

        $data = file_get_contents(__DIR__ . '/Fixtures/' . $this->getName() . '.json');
        $client = $this->makeRequest('speicher210_fastbill_notification_payment_chargeback', $data, $client);

        $this->assertSame(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());
    }
}
