<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    protected $user_name;
    protected $user_want;

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('{message}', function ($botman, $message) {
            $this->conversation($botman);
        });
        $botman->listen();

    }

    /**
     * Place your BotMan logic here.
     */
    public function conversation($botman)
    {
        $botman->ask('Hello! What is your name?', function (Answer $answer, $botman) {
            $botman->user_name = $answer->getText();
            $botman->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');

            $botman->ask('What country do you live in, ' . $this->user_name . '?', function (Answer $answer, $botman) {
                $this->user_want['abroad']['country'] = strtoupper($answer->getText());
                $countries = ['AFGHANISTAN', 'AlASKA', 'ALBANIA', 'ALGERIA', 'ANDORRA', 'ANGOLA', 'ANTIGUA & DEPS', 'ARGENTINA', 'ARMENIA', 'AUSTRALIA', 'AUSTRIA', 'AZERBAIJAN', 'BAHAMAS', 'THE BAHAMAS', 'BAHRAIN', 'BANGLADESH', 'BARBADOS', 'BELARUS', 'BELGIUM', 'BELIZE', 'BENIN', 'BHUTAN', 'BOLIVIA', 'BOSNIA HERZEGOVINA', 'BOTSWANA', 'BRAZIL', 'BRUNEI', 'BULGARIA', 'BURKINA', 'BURUNDI', 'CAMBODIA', 'CAMEROON', 'CANADA', 'CAPE VERDE', 'CENTRAL AFRICAN REP', 'CHAD', 'CHILE', 'CHINA', 'COLOMBIA', 'COMOROS', 'CONGO', 'THE CONGO', 'COSTA RICA', 'CROATIA', 'CUBA', 'CYPRUS', 'CZECH REPUBLIC', 'DENMARK', 'DJIBOUTI', 'DOMINICA', 'DOMINICAN REPUBLIC', 'EAST TIMOR', 'ECUADOR', 'EGYPT', 'EL SALVADOR', 'EQUATORIAL GUINEA', 'ERITREA', 'ESTONIA', 'ETHIOPIA', 'FIJI', 'FINLAND', 'FRANCE', 'FRENCH POLYNESIA', 'GABON', 'GAMBIA', 'GEORGIA', 'GERMANY', 'GHANA', 'GREECE', 'GRENADA', 'GUATEMALA', 'GUINEA', 'GUINEA-BISSAU', 'GUYANA', 'HAITI', 'HONDURAS', 'HUNGARY', 'ICELAND', 'INDIA', 'INDONESIA', 'IRAN', 'IRAQ', 'IRELAND', 'ISRAEL', 'ITALY', 'IVORY COAST', 'IVORY COAST', 'JAMAICA', 'JAPAN', 'JORDAN', 'KAZAKHSTAN', 'KENYA', 'KIRIBATI', 'NORTH KOREA NORTH', 'SOUTH KOREA', 'KOSOVO', 'KUWAIT', 'KYRGYZSTAN', 'LAOS', 'LATVIA', 'LEBANON', 'LESOTHO', 'LIBERIA', 'LIBYA', 'LIECHTENSTEIN', 'LITHUANIA', 'LUXEMBOURG', 'MACEDONIA', 'MADAGASCAR', 'MALAWI', 'MALAYSIA', 'MALDIVES', 'MALI', 'MALTA', 'MARSHALL ISLANDS', 'MAURITANIA', 'MAURITIUS', 'MEXICO', 'MICRONESIA', 'MOLDOVA', 'MONACO', 'MONGOLIA', 'MONTENEGRO', 'MOROCCO', 'MOZAMBIQUE', 'MYANMAR', 'NAMIBIA', 'NAURU', 'NEPAL', 'NETHERLANDS', 'NEW ZEALAND', 'NICARAGUA', 'NIGER', 'NIGERIA', 'NORWAY', 'OMAN', 'PAKISTAN', 'PALAU', 'PANAMA', 'PAPUA NEW GUINEA', 'PARAGUAY', 'PERU', 'PHILIPPINES', 'THE PHILIPPINES', 'POLAND', 'PORTUGAL', 'QATAR', 'ROMANIA', 'RUSSIAN FEDERATION', 'RUSSIA', 'RWANDA', 'ST KITTS & NEVIS', 'ST LUCIA', 'SAINT VINCENT & THE GRENADINES', 'SAMOA', 'SAN MARINO', 'SAO TOME & PRINCIPE', 'SAUDI ARABIA', 'SENEGAL', 'SERBIA', 'SEYCHELLES', 'SIERRA LEONE', 'SINGAPORE', 'SLOVAKIA', 'SLOVENIA', 'SOLOMON ISLANDS', 'SOMALIA', 'SOUTH AFRICA', 'SOUTH SUDAN', 'SPAIN', 'SRI LANKA', 'SUDAN', 'SURINAME', 'SWAZILAND', 'SWEDEN', 'SWITZERLAND', 'SYRIA', 'TAIWAN', 'TAJIKISTAN', 'TANZANIA', 'THAILAND', 'TOGO', 'TONGA', 'TRINIDAD & TOBAGO', 'TUNISIA', 'TURKEY', 'TURKMENISTAN', 'TUVALU', 'UGANDA', 'UKRAINE', 'UNITED ARAB EMIRATES', 'UAE', 'UNITED KINGDOM', 'UK', 'UNITED STATES', 'UNITED STATES OF AMERICA', 'USA', 'URUGUAY', 'UZBEKISTAN', 'VANUATU', 'VATICAN CITY', 'VENEZUELA', 'VIETNAM', 'YEMEN', 'ZAMBIA', 'ZIMBABWE'];

                if (!in_array($this->user_want['abroad']['country'], $countries)) {
                    $botman->say('I\'m sorry, but I don\'t know that country. Please check your spelling or choose the one closest, refresh and enter it again.');
                } else {
                    // abroad
                    $botman->ask('Thank you. Do you want to go abroad? (y\n)', function (Answer $answer, $botman) {
                        $this->user_want['abroad']['want'] = ($answer->getText()[0] == 'y');
                        // price
                        $botman->ask('Thank you. What\'s your ideal price for one night?', function (Answer $answer, $botman) {
                            $this->user_want['price'] = $answer->getText();
                            // location
                            $botman->ask('Thank you. What\'s your ideal location? (sea/city/mountain)', function (Answer $answer, $botman) {
                                // location
                                if (!in_array($answer->getText(), ['sea', 'city', 'mountain'])) {
                                    $botman->say('Invalid. Please start again.');
                                } else {
                                    $this->user_want['location'] = $answer->getText();
                                    $botman->ask('Thank you. How many stars would you like your destination to have (minimum)?', function (Answer $answer, $botman) {
                                        // stars
                                        switch (strtolower($answer->getText())) {
                                            case 1:
                                            case 'one':
                                                $this->user_want['stars'] = 1;
                                                break;
                                            case 2:
                                            case 'two':
                                                $this->user_want['stars'] = 2;
                                                break;
                                            case 3:
                                            case 'three':
                                                $this->user_want['stars'] = 3;
                                                break;
                                            case 4:
                                            case 'four':
                                                $this->user_want['stars'] = 4;
                                                break;
                                            case 5:
                                            case 'five':
                                                $this->user_want['stars'] = 5;
                                                break;
                                            default:
                                                $botman->say('Invalid. Please start again.');
                                                break;
                                        }
                                        $botman->ask('Thank you. What\'s your ideal temperature? (cold/mild/hot)?', function (Answer $answer, $botman) {
                                            // temperature
                                            if (!in_array($answer->getText(), ['cold', 'mild', 'hot'])) {
                                                $botman->say('Invalid. Please start again.');
                                            } else {
                                                $this->user_want['temperature']['ideal'] = $answer->getText();
                                                $botman->ask('Thank you. Would you rather your destination be active or lazy? (active/lazy)', function (Answer $answer, $botman) {
                                                    // activity
                                                    if (!in_array($answer->getText(), ['active', 'lazy'])) {
                                                        $botman->say('Invalid. Please start again.');
                                                    } else {
                                                        $this->user_want['activity'] = $answer->getText();

                                                        // show choices
                                                        switch ($this->user_want['location']) {
                                                            case ('sea'):
                                                                $location_to_say = 'by the sea';
                                                                break;
                                                            case ('city'):
                                                                $location_to_say = 'in the city';
                                                                break;
                                                            case ('mountain'):
                                                                $location_to_say = 'on a mountain';
                                                                break;
                                                        }
                                                        $activity_to_say = (in_array(strtolower(substr($this->user_want['activity'], 0, 1)), ['a', 'e', 'i', 'o', 'u']) ? 'an ' : 'a ') . $this->user_want['activity'];
                                                        if ($this->user_want['abroad']['want']) {
                                                            $abroad_to_say = 'somewhere abroad';
                                                        } else {
                                                            if (in_array($this->user_want['abroad']['country'], ['UAE', 'UK', 'USA'])) {
                                                                // needs same casing
                                                                $abroad_to_say = $this->user_want['abroad']['country'];
                                                            } else {
                                                                // needs word casing
                                                                $abroad_to_say = 'in ' . ucwords(strtolower($this->user_want['abroad']['country']));
                                                            }
                                                        }
                                                        if ($this->user_want['stars'] == 5) {
                                                            $stars_to_say = '5 stars';
                                                        } elseif ($this->user_want['stars'] == 1) {
                                                            $stars_to_say = '1 star';
                                                        } else {
                                                            $stars_to_say = $this->user_want['stars'] . ' or more stars';
                                                        }

                                                        $botman->say(
                                                            'According to the information you\'ve provided, ' .
                                                            $this->user_name . ', you\'d like ' .
                                                            $activity_to_say . ' and ' .
                                                            $this->user_want['temperature']['ideal'] . ' holiday ' .
                                                            $location_to_say . ' ' .
                                                            $abroad_to_say . ', in a hotel with ' .
                                                            $stars_to_say . ', that costs around ' .
                                                            $this->user_want['price'] . ' a night.'
                                                        );

                                                        $botman->ask('Say something to see your results.', function (Answer $answer, $botman) {
                                                            // weight holidays
                                                            $this->holidays = Holiday::all()->toArray();
                                                            for ($holiday = 0; $holiday < count($this->holidays); $holiday++) {
                                                                $this->holidays[$holiday]['Weight'] = 0;

                                                                // Price - 4 max
                                                                // 0 - half more
                                                                // 1 - quarter more
                                                                // 2 - around same
                                                                // 3 - quarter less
                                                                // 4 - half less
                                                                $hol_price = $this->holidays[$holiday]['PricePerNight'];
                                                                $want_price = $this->user_want['price'];
                                                                $price_quarter = $want_price / 4;
                                                                $price_half = $want_price / 2;

                                                                if ($hol_price >= $want_price + $price_quarter) {
                                                                    // quarter more
                                                                    $this->holidays[$holiday]['Weight'] = 1;
                                                                } elseif ($hol_price < $want_price + $price_quarter && $hol_price >= $want_price - $price_quarter) {
                                                                    // around same
                                                                    $this->holidays[$holiday]['Weight'] = 2;
                                                                } elseif ($hol_price < $want_price - $price_quarter && $hol_price >= $want_price - $price_half) {
                                                                    // quarter less
                                                                    $this->holidays[$holiday]['Weight'] = 3;
                                                                } elseif ($hol_price < $want_price - $price_half) {
                                                                    // half less
                                                                    $this->holidays[$holiday]['Weight'] = 4;
                                                                }

                                                                // Abroad - 2 max
                                                                // 0 - is not what user wants
                                                                // 2 - is what user wants
                                                                if (($this->holidays[$holiday]['Country'] == $this->user_want['abroad']['country']) == $this->user_want['abroad']['want']) {
                                                                    // hotel is local and user wants to be local OR
                                                                    // hotel is abroad and user wants to be abroad
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 2;
                                                                }

                                                                // Location - 2 max
                                                                // 0 - is not what user wants
                                                                // 2 - is what user wants
                                                                if ($this->holidays[$holiday]['Location'] == $this->user_want['location']) {
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 2;
                                                                }

                                                                // Stars - 2 max
                                                                // 0 - lower than minimum wanted
                                                                // 1 - is minimum wanted
                                                                // 2 - higher than minimum wanted
                                                                $hol_stars = $this->holidays[$holiday]['StarRating'];
                                                                $want_stars = $this->user_want['stars'];

                                                                if ($want_stars == 5 && $hol_stars == 5) {
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 2;
                                                                }

                                                                if ($hol_stars == $want_stars) {
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 1;
                                                                } elseif ($hol_stars > $want_stars) {
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 2;
                                                                }

                                                                // Activity - 1 max
                                                                // 1 - is what user wants
                                                                if ($this->holidays[$holiday]['Activity'] == $this->user_want['activity']) {
                                                                    $this->holidays[$holiday]['Weight'] = $this->holidays[$holiday]['Weight'] + 1;
                                                                }
                                                            }

                                                            // rank by weight, then price, then location, then stars
                                                            usort($this->holidays, function ($hol1, $hol2) {
                                                                if ($hol1['Weight'] == $hol2['Weight']) {
                                                                    // weights are the same
                                                                    if ($hol1['PricePerNight'] == $hol2['PricePerNight']) {
                                                                        // prices are the same
                                                                        return $hol2['StarRating'] <=> $hol1['StarRating'];
                                                                    } else {
                                                                        return $hol1['PricePerNight'] <=> $hol2['PricePerNight'];
                                                                    }
                                                                } else {
                                                                    return $hol2['Weight'] <=> $hol1['Weight'];
                                                                }
                                                            });

                                                            // show top 5
                                                            for ($holiday = 0; $holiday < 5; $holiday++) {
                                                                switch ($this->holidays[$holiday]['Location']) {
                                                                    case ('sea'):
                                                                        $location_to_say = 'by the sea';
                                                                        break;
                                                                    case ('city'):
                                                                        $location_to_say = 'in the city';
                                                                        break;
                                                                    case ('mountain'):
                                                                        $location_to_say = 'on a mountain';
                                                                        break;
                                                                }
                                                                if ($this->holidays[$holiday]['StarRating'] == 1) {
                                                                    $stars_to_say = '1 star';
                                                                } else {
                                                                    $stars_to_say = $this->holidays[$holiday]['StarRating'] . ' stars';
                                                                }
                                                                switch ($holiday) {
                                                                    case (0):
                                                                        $intro_to_say = 'Your first choice is a ';
                                                                        break;
                                                                    case (1):
                                                                        $intro_to_say = 'Second is a ';
                                                                        break;
                                                                    case (2):
                                                                        $intro_to_say = 'Third is a ';
                                                                        break;
                                                                    case (3):
                                                                        $intro_to_say = 'Penultimately, we have a ';
                                                                        break;
                                                                    case (4):
                                                                        $intro_to_say = 'Last but not least is a ';
                                                                        break;
                                                                }

                                                                $botman->say(
                                                                    $intro_to_say .
                                                                    $this->holidays[$holiday]['TempRating'] .
                                                                    ' and ' . $this->holidays[$holiday]['Activity'] .
                                                                    ' stay ' . $location_to_say .
                                                                    ' at ' . $this->holidays[$holiday]['HotelName'] .
                                                                    ' in ' . $this->holidays[$holiday]['City'] .
                                                                    ', ' . $this->holidays[$holiday]['Country'] .
                                                                    '. It holds ' . $stars_to_say .
                                                                    ' and costs ' . $this->holidays[$holiday]['PricePerNight'] .
                                                                    ' per night.'
                                                                );
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    });
                                }
                            });
                        });
                    });
                }
            });
        });
    }
}
