<?php


return [
    'h1' => "Калькулятор накоплений на пенсию",
    'seoTitle' => "Бесплатный калькулятор накоплений на пенсию",
    'seoDescription' => "Используйте наш бесплатный калькулятор накоплений на пенсию, чтобы оценить ваши цели по накоплениям. Поймите формулу сложного процента, рассчитайте ежемесячные или ежегодные взносы и сгенерируйте бесплатный PDF-отчет. Обеспечьте свое финансовое будущее уже сегодня.",
    'future_value_formula' => 'Формула для расчета будущей стоимости ваших текущих накоплений основана на сложных процентах. Она оценивает, на сколько увеличатся ваши текущие накопления со временем при фиксированной ежегодной процентной ставке.',
    'future_value_equation' => 'Будущая стоимость (БС) = Настоящая стоимость (НС) * (1 + Процентная ставка)^Количество лет (n)',
    'fv_description' => 'БС (Будущая стоимость) - это сумма, на которую вырастут ваши накопления в будущем.',
    'pv_description' => 'НС (Настоящая стоимость) - это ваши текущие накопления.',
    'interest_rate_description' => 'Процентная ставка - это годовая процентная ставка (выраженная в десятичных дробях).',
    'years_description' => 'Количество лет - это количество лет, в течение которых ваша сумма вложена или накоплена.',

    'amount_needed' => 'Сумма, которая требуется, представляет собой дополнительную сумму, которую вам нужно накопить, чтобы достичь вашей желаемой цели по накоплениям на пенсию. Она рассчитывается путем вычитания оцененной будущей стоимости (БС) из вашей цели по накоплениям на пенсию (необходимая сумма).',

    'monthly_payment_formula' => 'Расчет ежемесячного платежа определяет, сколько вам нужно откладывать каждый месяц, чтобы достичь вашей пенсионной цели. Он использует концепцию ежемесячных платежей по аннуитету, которые представляют собой фиксированную сумму, которую вы должны регулярно вкладывать, чтобы достичь конкретной будущей цели.',
    'monthly_payment_equation' => 'Ежемесячный Платеж = (Сумма, которая требуется * Ежемесячная процентная ставка) / (1 - (1 + Ежемесячная процентная ставка)^(-Количество месяцев))',
    'monthly_payment_description' => 'Ежемесячный Платеж - это сумма, которую вам нужно откладывать каждый месяц.',
    'monthly_payment_amount_needed_description' => 'Сумма, которая требуется - это дополнительная сумма, которую вам нужно откладывать (сумма, которая требуется).',
    'monthly_payment_interest_rate_description' => 'Ежемесячная Процентная ставка - это ежемесячный эквивалент вашей годовой процентной ставки (invReturn разделенная на 12).',
    'monthly_payment_months_description' => 'Количество месяцев - это общее количество месяцев до вашей пенсии (Количество лет умноженное на 12).',

    'yearly_payment' => 'Расчет ежегодного платежа аналогичен ежемесячному платежу, но учитывает ежегодные взносы. Он определяет, сколько вам нужно откладывать ежегодно, чтобы достичь вашей цели по пенсии.',
    'yearly_payment_equation' => 'Ежегодный Платеж = Сумма, которая требуется / ((1 - (1 + Ежегодная Процентная ставка)^(-Количество лет)) / (Ежегодная Процентная ставка))',
    'yearly_payment_description' => 'Ежегодный Платеж - это сумма, которую вам нужно откладывать каждый год.',
    'yearly_payment_amount_needed_description' => 'Сумма, которая требуется - это дополнительная сумма, которую вам нужно откладывать (сумма, которая требуется).',
    'yearly_payment_interest_rate_description' => 'Ежегодная Процентная ставка - это ваша годовая процентная ставка (invReturn как десятичная дробь).',
    'yearly_payment_years_description' => 'Количество лет - это общее количество лет до вашей пенсии (Количество лет для накопления).',
    'your_age_now' => 'Ваш возраст сейчас',
    'your_planned_retirement_age' => 'Ваш запланированный возраст пенсии',
    'amount_needed_at_retirement_age' => 'Сумма, необходимая на возрасте пенсии',
    'your_retirement_savings_now' => 'Ваши накопления на пенсии сейчас',
    'average_investment_return' => 'Средняя доходность инвестиций',
    'calculate_button' => 'Рассчитать',
    'clear_button' => 'Очистить',

    'results' => 'Результаты:',
    'monthly_savings_plan' => 'Если вы экономите каждый месяц до 67 лет',
    'amount_to_save_monthly' => 'Сумма для ежемесячного накопления:',
    'total_principal' => 'Итого по Основному долгу:',
    'total_interest' => 'Итого по Процентам:',
    'yearly_savings_plan' => 'Если вы экономите каждый год до 67 лет',
    'amount_to_save_yearly' => 'Сумма для ежегодного накопления:',
    'lump_sum_savings_plan' => 'Если у вас есть сумма сейчас',
    'additional_amount_needed' => 'Дополнительная сумма, необходимая:',
];
