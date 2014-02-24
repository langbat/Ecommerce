<?php

/**
 * This is the model class for table "transactions".
 *
 * The followings are the available columns in table 'transactions':
 * @property integer $id
 * @property integer $user_id
 * @property string $amount
 * @property string $currency
 * @property integer $paymentstatus
 * @property string $transactiontype
 * @property string $modified
 * @property string $created
 * @property string $payment_transaction
 * @property string $options
 * @property integer $payment_method_id
 *
 * The followings are the available model relations:
 * @property Members $user
 */
class Transactions extends CActiveRecord
{
    const STATUS_OPEN = 1;
    const STATUS_APPROVED = 2;
    const STATUS_CENCELLED = 3;

    const CASHOUT_MIN = 5;
    const CASHOUT_MAX = 6;
    const CASHOUT_FEE = 2;

    const DEFAULT_CRATE = 0;

    const TYPE_ADD_FUND = 1;
    const TYPE_CASHBACK = 2;
    const TYPE_BID = 3;
    const TYPE_CREDIT_PRODUCT = 4;
    const TYPE_ORDER = 5;
    const TYPE_CASHBACK2 = 6;
    const TYPE_CASHBACK3 = 7;
    const TYPE_JOIN = 11;

    const TYPE_BONUS_HOLIDAY = 8;
    const TYPE_BONUS_INPAYMENT = 9;
    const TYPE_BONUS_1STPLACE = 10;

    public $username;

    /**
     * Returns the static model of the specified AR class.
     * @return Transactions the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transactions';
    }
    public function behaviors()
    {
        return array('datetimeI18NBehavior' => array('class' =>
                    'ext.DateTimeI18NBehavior'));
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs., payment_transaction
        return array(
            array('user_id, amount, created', 'required'),
            array(
                'user_id, paymentstatus, payment_method_id',
                'numerical',
                'integerOnly' => true),
            array(
                'amount, transactiontype',
                'length',
                'max' => 10),
            array(
                'currency',
                'length',
                'max' => 3),
            array('modified', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, user_id, amount, currency, paymentstatus, transactiontype, modified, created, payment_transaction, options, payment_method_id,username',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'paymentMethod' => array(
                self::BELONGS_TO,
                'PaymentMethods',
                'payment_method_id'),
            'user' => array(
                self::BELONGS_TO,
                'Members',
                'user_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('global', 'ID'),
            'user_id' => Yii::t('global', 'User'),
            'amount' => Yii::t('global', 'Amount'),
            'currency' => Yii::t('global', 'Currency'),
            'paymentstatus' => Yii::t('global', 'Status'),
            'transactiontype' => Yii::t('global', 'Type'),
            'modified' => Yii::t('global', 'Modified'),
            'created' => Yii::t('global', 'Created'),
            'payment_transaction' => Yii::t('global', 'Payment Transaction'),
            'options' => Yii::t('global', 'Options'),
            'payment_method_id' => Yii::t('global', 'Payment Method'),
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->together = true;
        $criteria->with = array('user');

        if (isset($_GET['from_time']) && $_GET['from_time'] != '') {
            $criteria->addCondition('DATE(created) >= "' . date('Y-m-d', strtotime($_GET['from_time'])) .
                '"');
        }
        if (isset($_GET['to_time']) && $_GET['to_time'] != '') {
            $criteria->addCondition('DATE(created) <= "' . date('Y-m-d', strtotime($_GET['to_time'])) .
                '"');
        }
        //$amount =number_format(floatval(substr($this->amount,0,(strrpos($this->amount,'€')-1))),2, '.', ',');

        $amount = floatval(str_replace(',', '.', str_replace('.', '', $this->amount)));
        $criteria->compare('t.id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        if ($this->amount != '' && ctype_digit($this->amount))
            $criteria->addCondition('amount = ' . $this->amount . ' OR amount = -' . $amount);
        else {
            $criteria->compare('amount', $this->amount, true);
        }
        $criteria->compare('currency', $this->currency, true);
        $criteria->compare('paymentstatus', $this->paymentstatus);
        $criteria->compare('transactiontype', $this->transactiontype);
        $criteria->compare('modified', $this->modified, true);

        $criteria->compare('user.username', $this->username);

        if ($this->created)
            $criteria->compare('DATE(created)', date('Y-m-d', strtotime($this->created)));
        $criteria->compare('payment_transaction', $this->payment_transaction, true);
        $criteria->compare('options', $this->options, true);
        //$criteria->order='created DESC';
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 't.id DESC',
                'attributes' => array(
                    'username' => array(
                        'asc' => 'user.username',
                        'desc' => 'user.username DESC',
                        ),
                    '*',
                    ),
                ),

            ));
    }

    function statistics()
    {
        $funds = array(
            'balance' => Yii::app()->db->createCommand()->from('transactions')->select('SUM(amount)')->
                queryScalar(),
            'addfund' => Yii::app()->db->createCommand()->from('transactions')->select('SUM(amount)')->
                where('transactiontype = ' . self::TYPE_ADD_FUND)->queryScalar(),
            'bids' => Yii::app()->db->createCommand()->from('transactions')->select('SUM(amount)')->
                where('transactiontype = ' . self::TYPE_BID)->queryScalar() * -1,
            'sales' => Yii::app()->db->createCommand()->from('orders')->select('SUM(amount)')->
                queryScalar(),
            );
        $funds['revenue'] = $funds['addfund'] + $funds['sales'];
        $funds['stas_chart'] = $funds['addfund'] . ',' . $funds['addfund'] . ',' . $funds['sales'] .
            ',' . $funds['bids'];
        return $funds;
    }

    function statisticsRevenue()
    {
        $sql = "
        SELECT `name`, SUM(today) today, SUM(tomorrow) tomorrow, orderlist
        FROM(
        SELECT 'Payment-in' AS `name`, SUM(amount) AS today, 0 AS tomorrow,1 AS orderlist FROM transactions WHERE  DATE(created) = '" .
            date('Y-m-d') . "' AND transactiontype=" . self::TYPE_ADD_FUND . "
        UNION SELECT 'Payment-in', 0, SUM(amount), 1 FROM transactions WHERE DATE(created) = '" .
            date('Y-m-d', time() - 24 * 3600) . "' AND transactiontype=" . self::
            TYPE_ADD_FUND . "
        UNION SELECT 'New customer', COUNT(*), 0,3 AS orderlist FROM members WHERE DATE(FROM_UNIXTIME(joined)) = '" .
            date('Y-m-d') . "'
        UNION SELECT 'New customer', 0 , COUNT(*),3 FROM members WHERE DATE(FROM_UNIXTIME(joined)) = '" .
            date('Y-m-d', time() - 24 * 3600) . "'
        UNION SELECT 'Orders', SUM(amount), 0,2 AS orderlist FROM orders WHERE DATE(created) = '" .
            date('Y-m-d') . "'
        UNION SELECT 'Orders', 0, SUM(amount),2 FROM orders WHERE DATE(created) = '" .
            date('Y-m-d', time() - 24 * 3600) . "'
        UNION SELECT 'Logger in', visitors, 0,4 AS orderlist FROM visitors WHERE `date` = '" .
            date('Y-m-d') . "'
        UNION SELECT 'Logger in', 0, visitors,4 AS orderlist FROM visitors WHERE `date` = '" .
            date('Y-m-d', time() - 24 * 3600) . "'
        UNION SELECT 'Total Bid' AS `name`, COUNT(id) AS today, 0 AS tomorrow,6 AS orderlist FROM bids WHERE  DATE(created) = '" .
            date('Y-m-d') . "' 
        UNION SELECT 'Total Bid', 0, COUNT(id), 6 FROM bids WHERE DATE(created) = '" .
            date('Y-m-d', time() - 24 * 3600) . "' 
        UNION SELECT 'Page Views', page_views, 0,5 AS orderlist FROM visitors WHERE `date` = '" .
            date('Y-m-d') . "'
        UNION SELECT 'Page Views', 0 , page_views,5 AS orderlist FROM visitors WHERE `date` = '" .
            date('Y-m-d', time() - 24 * 3600) . "' ) Revenue
        GROUP BY `name`
        ORDER BY `orderlist`";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function getDescription($trans_type, $payment_trans)
    {
        if ($trans_type == self::TYPE_ORDER) {
            return "<a href='/orders/view?id=" . $payment_trans . "' >" . Yii::t('global',
                'Paypal') . "</a>";
        }
        if ($trans_type == self::TYPE_ADD_FUND || $trans_type == self::TYPE_CASHBACK) {
            return Yii::t('global', 'Paypal');

        }
        // temporary solution
        if ($trans_type == self::TYPE_BONUS_HOLIDAY || $trans_type == self::
            TYPE_BONUS_INPAYMENT) {
            //return Yii::t('global','Bonus');

        } else {
            $compare = ($payment_trans != '') ? $payment_trans : 0;
            $criteria = new CDbCriteria;
            $criteria->condition = 'id =' . $compare;
            $auction = Auctions::model()->find($criteria);
            return "<a href='/auctions/detail?id=" . $payment_trans .
                "' style='color: #A10EA1;'>" . $auction['product']['name'] . "</a>";
        }
    }


}
