<?php

return [
    'h1' => "退休储蓄计算器",
    'seoTitle' => "免费退休储蓄计算器",
    'seoDescription' => "使用我们的免费退休储蓄计算器来估算您的储蓄目标。了解复利公式，计算每月或每年的储蓄金额，并免费生成PDF报告。立即确保您的财务未来。",
    'future_value_formula' => '用于计算当前储蓄的未来价值的公式基于复利。它估算了在固定年利率下，您当前储蓄将在未来增长多少。',
    'future_value_equation' => '未来价值（FV）= 现值（PV）*（1 + 利率）^年数（n）',
    'fv_description' => '未来价值（FV）是您的储蓄将来会增加到的金额。',
    'pv_description' => '现值（PV）是您当前的储蓄。',
    'interest_rate_description' => '利率是年利率（以小数表示）。',
    'years_description' => '年数是您的资金投资或储蓄的年数。',

    'amount_needed' => '所需金额表示您需要额外储蓄以达到期望的退休储蓄目标。它是通过从估算的未来价值（FV）中减去您的退休储蓄目标（所需金额）来计算的。',

    'monthly_payment_formula' => '每月付款计算确定每月需要储蓄多少才能达到您的退休目标。它使用年金支付的概念，这是您需要定期投资以实现特定未来目标的固定金额。',
    'monthly_payment_equation' => '每月付款=（所需金额 * 月利率）/（1 -（1 + 月利率）^（-月数））',
    'monthly_payment_description' => '每月付款是您需要每月储蓄的金额。',
    'monthly_payment_amount_needed_description' => '所需金额是您需要额外储蓄的金额（所需金额）。',
    'monthly_payment_interest_rate_description' => '月利率是您年度利率的月度等值（invReturn除以12）。',
    'monthly_payment_months_description' => '月数是直到退休的总月数（年数乘以12）。',

    'yearly_payment' => '年付款计算类似于每月付款，但考虑年度贡献。它计算了为达到您的退休目标每年需要储蓄多少。',
    'yearly_payment_equation' => '年付款= 所需金额 / ((1 -（1 + 年度利率）^（-年数））/（年度利率）)',
    'yearly_payment_description' => '年付款是您每年需要储蓄的金额。',
    'yearly_payment_amount_needed_description' => '所需金额是您需要额外储蓄的金额（所需金额）。',
    'yearly_payment_interest_rate_description' => '年度利率是您的年度利率（invReturn作为小数）。',
    'yearly_payment_years_description' => '年数是直到退休的总年数（年数乘以12）。',
    'your_age_now' => '您现在的年龄',
    'your_planned_retirement_age' => '您计划的退休年龄',
    'amount_needed_at_retirement_age' => '退休年龄时所需金额',
    'your_retirement_savings_now' => '您现在的退休储蓄',
    'average_investment_return' => '平均投资回报率',
    'calculate_button' => '计算',
    'clear_button' => '清除',

    'results' => '结果：',
    'monthly_savings_plan' => '如果您每月储蓄直到67岁',
    'amount_to_save_monthly' => '每月需要储蓄的金额：',
    'total_principal' => '总本金：',
    'total_interest' => '总利息：',
    'yearly_savings_plan' => '如果您每年储蓄直到67岁',
    'amount_to_save_yearly' => '每年需要储蓄的金额：',
    'lump_sum_savings_plan' => '如果您现在有这笔钱',
    'additional_amount_needed' => '额外所需金额：',
];
