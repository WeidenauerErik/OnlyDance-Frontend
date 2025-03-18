export interface FootStep {
    height: number;
    width: number;
    rotate: number;
    footToesActive: boolean;
    footHeelActive: boolean;
}

export interface Step {
    howQuick: number;
    man: {
        leftFoot: FootStep;
        rightFoot: FootStep;
    };
    woman: {
        leftFoot: FootStep;
        rightFoot: FootStep;
    };
}